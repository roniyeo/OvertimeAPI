<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function post(EmployeeRequest $request)
    {
        $employee = Employee::create([
            'name' => $request->name,
            'status_id' => $request->status_id,
            'salary' => $request->salary,
         ]);

        if ($employee) {
            return response()->json([
                'success' => true,
                'message' => 'Success Add Employee Data!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed Add Employee Data!',
            ], 401);
        }
    }

    public function per_page()
    {
        $employee = Employee::paginate(10);
        return new EmployeeResource($employee);
    }

    public function page()
    {
        $employee = Employee::paginate(10, ['*'], 'page', 1);
        return new EmployeeResource($employee);
    }

    public function order_by_name_asc()
    {
        $employee = Employee::orderBy('name','asc')->paginate(10);
        return new EmployeeResource($employee);
    }

    public function order_by_name_desc()
    {
        $employee = Employee::orderBy('name','desc')->paginate(10);
        return new EmployeeResource($employee);
    }

    public function order_by_salary_asc()
    {
        $employee = Employee::orderBy('salary','asc')->paginate(10);
        return new EmployeeResource($employee);
    }

    public function order_by_salary_desc()
    {
        $employee = Employee::orderBy('salary','desc')->paginate(10);
        return new EmployeeResource($employee);
    }
}
