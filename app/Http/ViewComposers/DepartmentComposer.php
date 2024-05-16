<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use App\Models\Department;

class DepartmentComposer
{
    protected $departments;

    public function __construct(Department $departments)
    {
        $this->departments = $departments;
    }

    public function compose(View $view)
    {
        $view->with('departments', $this->departments->all());
    }
}
