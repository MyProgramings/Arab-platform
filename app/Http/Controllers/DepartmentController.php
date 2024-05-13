<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Material;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $title = 'الأقسام';
        return view('departments.index', compact('departments', 'title'));
    }
   
    public function materials_by_department($id)
    {
        $materials = Material::where('department_id', $id)->get();
        $department_name = Material::where('department_id', $id)->first();
        $department_id = $department_name->id;
        $title = Material::where('department_id', $id)->first();
        return view('departments.depart_operation', compact('materials', 'title', 'department_id'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Department::create([
            'name'       => $request->name,
        ]);

        return redirect()->back()->with(
            'success',
            'تم اضافه القسم بنجاح'
        );
    }

    public function show(Department $department)
    {
        return view('departments.my-videos');
    }

    public function edit(Department $department)
    {
        //
    }

    public function update(Request $request, Department $department)
    {
        //
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        
        $department->delete();

        return back()->with('success', 'تم حذف القسم بنجاح');
    }
}
