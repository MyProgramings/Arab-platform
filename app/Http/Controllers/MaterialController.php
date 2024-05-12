<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Homework;
use App\Models\Lecture;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();
        $title = 'المواد';
        return view('admin.materials.index', compact('materials', 'title'));
    }

    public function materials_by_department($id)
    {
        $materials = Material::where('department_id', $id)->get();
        $department = Material::where('department_id', $id)->first();
        return view('materials.materials_by_department', compact('materials', 'department', 'id'));
    }

    public function download_file($id)
    {
        $lecture = Lecture::find($id);
        return Storage::disk('public')->download($lecture->file_path);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $departments = Department::get();
        return view('materials.uploader', compact('departments', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'title' => 'required',
        ]);

        Material::create([
            'department_id'       => $request->department_id,
            'title'       => $request->title,
        ]);

        return redirect()->back()->with(
            'success',
            'تم اضافه المادة بنجاح'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        $lectures = Lecture::all();
        $homeworks = Homework::all();
        return view('materials.show', compact('material', 'lectures', 'homeworks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
