<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
    public function index()
    {
        $materials = Material::get();
        return view('lectures.uploader', compact('materials'));
    }

    public function create()
    {
        $materials = Material::get();
        return view('lectures.uploader', compact('materials'));
    }

    public function download_file($id)
    {
        $lecture = Lecture::find($id);
        return Storage::disk('public')->download($lecture->file_path);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'material_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('file_path')){
            $file = $request->file('file_path');
            $file_path = time() . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('',$file_path);
        }
        else
            $file_path = 'No File';

        $video = Lecture::create([
            'material_id'       => $request->material_id,
            'title'       => $request->title,
            'description'       => $request->description,
            'file_path'       => $file_path,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->back()->with(
            'success',
            'تم اضافه المحاضرة بنجاح'
        );
    }
}
