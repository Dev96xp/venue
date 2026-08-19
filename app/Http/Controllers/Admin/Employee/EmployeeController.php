<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employees.index');
    }
}
