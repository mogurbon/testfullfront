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

    public function updateEmployee(Request $request, $employee_id){

        try{
            DB::beginTransaction();
            $employee = Employee::find($employee_id);
            $employee->name =  $request->input('name');
            $employee->email = $request->input('email');
            $employee->position = $request->input('position');
            $employee->address = $request->input('address');
            $employee->coordinates = $request->input('coordinates');
            $employee->birthday = $request->input('birthday');

            $skills = $request->input('skills');

            if (isset($skills) and count($skills) > 0){
                $employee->skills()->detach();
                $employee->skills()->attach($skills);
            }
            $employee->save();
            DB::commit();
            $response = ['object' => null, 'error' => false, 'message' => 'Movie Updated'];
        }catch (\Exception $e){
            DB::rollback();
            $response = ['object' => null, 'error' => true, 'message' => $e->getMessage()];
        }

        return $response;
    }


    public function editEmployee($id){
        return view('content.editemployee',['employee_id' => $id]);
    }

    public function getEmployee($employee_id){



        return Employee::with('skills')->find($employee_id);

    }
}
