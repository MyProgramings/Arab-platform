<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveredController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.main');
})->name('dashboard');

Route::get('/', 'App\Http\Controllers\MainController@index')->name('main');
Route::get('/main/{channel}/videos', 'App\Http\Controllers\MainController@channelsVideos')->name('main.channels.videos');

Route::resource('/videos', 'App\Http\Controllers\VideoController');

Route::resource('/departments', DepartmentController::class);

Route::get('/department/materials/{id}', [MaterialController::class, 'materials_by_department'])->name('material_by_department');

Route::get('/materials/create/{id}', [MaterialController::class, 'create'])->name('materials.create_with_department');

Route::get('/download/file/{id}', [MaterialController::class, 'download_file'])->name('material-download-file');

Route::get('/download/file/{id}', [LectureController::class, 'download_file'])->name('lecture.download_file');
Route::get('/homework/download/file/{id}', [HomeworkController::class, 'download_file'])->name('homework.download_file');

Route::resource('/materials', MaterialController::class);

Route::resource('/lecture', LectureController::class);

Route::resource('/homework', HomeworkController::class);

Route::resource('/delivered', DeliveredController::class);

Route::get('/homework/delivered/{id}', [DeliveredController::class, 'create_by_homework'])->name('homework.delivered.create');
Route::get('/delivered/download/file/{id}', [DeliveredController::class, 'download_file'])->name('delivered-file');



Route::get('/video/search', 'App\Http\Controllers\VideoController@search')->name('video.search');

Route::post('/like','App\Http\Controllers\LikeController@LikeVideo')->name('like');

Route::post('/view','App\Http\Controllers\VideoController@addView')->name('view');

Route::post('/comment','App\Http\Controllers\CommentController@saveComment')->name('comment');
Route::get('/comment/{id}/edit','App\Http\Controllers\CommentController@edit')->name('comment.edit');
Route::patch('/comment/{id}','App\Http\Controllers\CommentController@update')->name('comment.update');
Route::get('/comment/{id}','App\Http\Controllers\CommentController@destroy')->name('comment.destroy');

Route::get('/history','App\Http\Controllers\HistoryController@index')->name('history');
Route::delete('/history/{id}','App\Http\Controllers\HistoryController@destroy')->name('history.destroy');
Route::delete('/destroyAll', 'App\Http\Controllers\HistoryController@destroyAll')->name('history.distroyAll');

Route::get('/channel', 'App\Http\Controllers\ChannelController@index')->name('channel.index');
Route::get('/channel/search', 'App\Http\Controllers\ChannelController@search')->name('channel.search');

Route::post('/notification','App\Http\Controllers\NotificationController@index')->name('notification');
Route::get('/notification','App\Http\Controllers\NotificationController@allNotification')->name('all.Notification');


Route::prefix('/admin')->middleware('can:update-videos')->group(function() {
    Route::get('/', 'App\Http\Controllers\AdminsController@index')->name('admin.index');
    Route::get('/channels', 'App\Http\Controllers\ChannelController@adminIndex')->name('channels.index');
    Route::patch('/{user}/channels', 'App\Http\Controllers\ChannelController@adminUpdate')->name('channels.update')->middleware('can:update-users');
    Route::delete('/channels/{user}','App\Http\Controllers\ChannelController@adminDestroy')->name('channels.delete')->middleware('can:update-users');
    Route::patch('/{user}/block', 'App\Http\Controllers\ChannelController@adminBlock')->name('channels.block')->middleware('can:update-users');;
    Route::get('/channels/blocked', 'App\Http\Controllers\ChannelController@blockedChannels')->name('channels.blocked');
    Route::patch('/{user}/open', 'App\Http\Controllers\ChannelController@openBlock')->name('channels.open.block')->middleware('can:update-users');;
    Route::get('/allChannels', 'App\Http\Controllers\ChannelController@allChannels')->name('channels.all');
    Route::get('/MostViewedVideos', 'App\Http\Controllers\VideoController@mostViewedVideos')->name('most.viewed.video');
});
