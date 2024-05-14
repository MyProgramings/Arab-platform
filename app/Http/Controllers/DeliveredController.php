<?php

namespace App\Http\Controllers;

use App\Models\Delivered;
use App\Models\Homework;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeliveredController extends Controller
{
    public function index()
    {
        $delivereds = Delivered::get();
        return view('delivereds.uploader', compact('delivereds'));
    }
    public function create_by_homework($id)
    {
        $homework = Homework::find($id);
        $material_id = $homework->material_id;
        return view('delivereds.uploader', compact('id', 'material_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'material_id' => 'required',
            'homework_id' => 'required',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_path = time() . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('file', $file_path);
        } else
            $file_path = 'No File';

        Delivered::create([
            'title'       => $request->title,
            'file_path'       => $file_path,
            'material_id'       => $request->material_id,
            'homework_id'       => $request->homework_id,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('homework.show', $request->material_id)->with(
            'success',
            'تم اضافه  التكليف بنجاح'
        );
    }

    public function show($id)
    {
        // $material = Material::find($id);
        $homework = Homework::find($id);
        $delivereds = Delivered::all();
        return view('delivereds.show', compact('homework', 'delivereds'));
    }
    public function download_file($id)
    {
        $delivered = Delivered::find($id);
        return Storage::disk('public')->download($delivered->file_path);
    }
}
