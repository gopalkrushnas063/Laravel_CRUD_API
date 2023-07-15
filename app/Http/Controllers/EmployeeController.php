<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller{

    // Show all employee list
    public function index(){
        $employees = Employee::all();
        return response()->json($employees);
    }

    //Create Employee
    public function store(Request $request){
        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    //Show Employee By ID
    public function show($id){
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    // Update Employee By ID
    public function update(Request $request, $id){
        $employee = Employee::find($id);
    
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    
        $employee->update($request->all());
    
        return response()->json(['message' => 'Employee updated successfully', 'data' => $employee], 200);
    }
    

    // Delete Employee By ID
    public function destroy($id){
        $employee = Employee::find($id);
        
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        
        $employee->delete();
    
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
    
}

?>