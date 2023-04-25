<?php

namespace App\Http\Controllers;

use App\Imports\employeeImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employees;

class dashboard extends Controller
{
    //
    public function dashboard(Request $req)
    {
        return view('service.dashboard');
    }

    function importExl(Request $req)
    {
        $file = $req->file('excel_file');
        $from = date('Y-m-d H:i:s');
        Excel::import(new employeeImport, $file);
        $to = date('Y-m-d H:i:s');
        $importedData = Employees::whereBetween('created_at', [$from, $to])->get();
        return view("service.dashboard", compact('importedData'))->with('message', 'Excel file imported successfully');
    }
}
