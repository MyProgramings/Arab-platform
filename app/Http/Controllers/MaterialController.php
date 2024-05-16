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

    public function create($id)
    {
        $departments = Department::get();
        return view('materials.uploader', compact('departments', 'id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'level' => 'required',
            'department_id' => 'required',
            'title' => 'required',
        ]);

        Material::create([
            'level'       => $request->level,
            'user_id'       => auth()->id(),
            'department_id'       => $request->department_id,
            'title'       => $request->title,
        ]);

        return redirect()->back()->with(
            'success',
            'تم اضافه المادة بنجاح'
        );
    }

    public function show($id)
    {
        $material = Material::find($id);
        $lectures = Lecture::all();
        $homeworks = Homework::all();
        return view('materials.show', compact('material', 'lectures', 'homeworks'));
    }

    public function edit(Material $material)
    {
        //
    }

    public function update(Request $request, Material $material)
    {
        //
    }

    public function destroy($id)
    {
        $material = Material::find($id);
        
        $material->delete();

        return back()->with('success', 'تم حذف المادة بنجاح');
    }
}
