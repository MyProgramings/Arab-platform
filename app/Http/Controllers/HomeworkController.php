<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Material;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index()
    {
        $homeworks = Homework::get();
        return view('homeworks.uploader', compact('homeworks'));
    }

    public function create()
    {
        $homeworks = Homework::get();
        return view('homeworks.uploader', compact('homeworks'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'deadline' => 'required',
            'material_id' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_path = time() . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('file', $file_path);
        } else
            $file_path = 'No File';

        $video = Homework::create([
            'title'       => $request->title,
            'deadline'       => $request->deadline,
            'material_id'       => $request->material_id,
            'description'       => $request->description,
            'file_path'       => $file_path,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->back()->with(
            'success',
            'تم اضافه  التكليف بنجاح'
        );
    }

    public function show($id)
    {
        $material = Material::find($id);
        $homeworks = Homework::all();
        return view('homeworks.show', compact('material', 'homeworks'));
    }
}
