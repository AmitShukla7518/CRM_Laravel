<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use DataTables;

class PagesController extends Controller
{

     public function index(){
         return view('index');
     }

     // DataTable data
     public function getDataTableData(){
         $employees = Employees::select('*');

         return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('status', function($row){

                 if($row->status == 1){
                      return "Active";
                 }else{
                      return "Inactive";
                 }

            }) 
            ->addColumn('action', function($row){

                 // Update Button
                 $updateButton = "<button class='btn btn-sm btn-info updateUser' data-id='".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='fa-solid fa-pen-to-square'></i></button>";

                 // Delete Button
                 $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";

                 return $updateButton." ".$deleteButton;

            }) 
            ->make();
     }

     // Read Employee record by ID
     public function getEmployeeData(Request $request){

         ## Read POST data 
         $id = $request->post('id');

         $empdata = Employees::find($id);

         $response = array();
         if(!empty($empdata)){

             $response['emp_name'] = $empdata->emp_name;
             $response['email'] = $empdata->email;
             $response['city'] = $empdata->city;
             $response['gender'] = $empdata->gender;

             $response['success'] = 1;
         }else{
             $response['success'] = 0;
         }

         return response()->json($response);

     }

     // Update Employee record
     public function updateEmployee(Request $request){
         ## Read POST data
         $id = $request->post('id');

         $empdata = Employees::find($id);

         $response = array();
         if(!empty($empdata)){
              $updata['emp_name'] = $request->post('emp_name');
              $updata['email'] = $request->post('email');
              $updata['gender'] = $request->post('gender');
              $updata['city'] = $request->post('city');

              if($empdata->update($updata)){
                   $response['success'] = 1;
                   $response['msg'] = 'Update successfully'; 
              }else{
                   $response['success'] = 0;
                   $response['msg'] = 'Record not updated';
              }

         }else{
              $response['success'] = 0;
              $response['msg'] = 'Invalid ID.';
         }

         return response()->json($response); 
     }

     // Delete Employee
     public function deleteEmployee(Request $request){

         ## Read POST data
         $id = $request->post('id');

         $empdata = Employees::find($id);

         if($empdata->delete()){
             $response['success'] = 1;
             $response['msg'] = 'Delete successfully'; 
         }else{
             $response['success'] = 0;
             $response['msg'] = 'Invalid ID.';
         }

         return response()->json($response); 
     }

}