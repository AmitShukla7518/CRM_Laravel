<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\APIDemos;

class ApiDemo extends Controller
{
    //For Demo purposes
    public function Testing()
    {
        return ["name" => "Amit Shukla", "description" => "Working On Cogent E-Servises LTD Noida", "Department" => "Software Development"];
    }

    // Return All List of Table's Data
    function List()
    {
        return APIDemos::all();
    }

    // Get Data With Params (ID is Optional)

    function GetByID($id = null)
    {
        return $id?APIDemos::find($id):APIDemos::all();
    }

    function AddAPI(Request $req )
    {


      //  return ["name" => "Amit Shukla", "description" => "Working On Cogent E-Servises LTD Noida", "Department" => "Software Development"];
       $addData = new APIDemos;
       $addData->EmployeeId = $req->EmployeeId;
       $addData->EmployeeId = $req->Name;
       $addData->EmployeeId = $req->Address;
       $addData->EmployeeId = $req->MobileNo;
       $addData->EmployeeId = $req->Email;
       $addData->EmployeeId = $req->password;
       $result = $addData->save();
       if ($result) {
       return ["Massage"=>"Data Saved Succesfully in Database"];
       } else {
        ["Faild"=>"Data Can't Save in Database"];
       }
       


    }
}
