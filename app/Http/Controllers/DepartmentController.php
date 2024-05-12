<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Material;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments.my-videos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
