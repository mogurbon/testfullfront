<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
        return view('content.content');
        #return view('main');
    }
    public function getEmployees(){
        return Employee::all();
    }
    public function newEmployee(){
        return view('content.newemployee');
    }
    public function store(Request $request){


        try{

            DB::beginTransaction();
            $employee = new Employee();
            $employee->name =  $request->input('name');
            $employee->email = $request->input('email');
            $employee->position = $request->input('position');
            $employee->address = $request->input('address');
            $employee->coordinates = $request->input('coordinates');
            $employee->birthday = $request->input('birthday');
            $employee->save();
            DB::commit();
            $response = ['object' => null, 'error' => false, 'message' => 'Empleado Guardado'];
        }catch (\Exception $e){
            DB::rollback();
            $response = ['object' => null, 'error' => true, 'message' => $e->getMessage()];
        }
        return $response;


    }
}
