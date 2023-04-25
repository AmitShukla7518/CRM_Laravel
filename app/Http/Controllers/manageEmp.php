<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Employees;
use Yajra\Datatables\DataTables;


class manageEmp extends Controller
{
    //For Show Create Employee Form
    public function CreateEMP()
    {
        return view("service.create");
    }


    public function Store(Request $req)
    {
        $validater = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|min:3',
            'docID' => 'required',
            'address' => 'required|min:3',
            'image' => 'sometimes|image:jpeg,png,jpg,gif',
        ]);
        if ($validater->passes()) {
            # Save data in database
            $generator = "1357902468";
            $result = "";
            for ($i = 1; $i <= 8; $i++) {
                $result .= substr($generator, (rand() % (strlen($generator))), 1);
            }
            $employee  = new Employees();
            $employee->EmployeeID = "CE" . $result;
            $employee->name = $req->name;
            $employee->email = $req->email;
            $employee->docID = $req->docID;
            $employee->address = $req->address;
            if ($req->image) {
                $imageName = time() . '.' . $req->image->extension();

                $dest = public_path('uploads/employees/');
                $req->image->move($dest, $imageName); //This Will Save File to Public Folder)
                $employee->image = $imageName;
                $employee->save();
            }
            $employee->save();
            // $req->session()->flash('success', 'Employee Added Successfully'); // This should redirect to the list page
            // return redirect()->route('show');
            return redirect('show')->with('success', 'Employee Added Successfully');
        } else {
            #return With Error on Create Employee Form 
            return redirect()->route('login')->withErrors($validater)->withInput();
        }
    }





    function showEmp()
    {
        $employees = Employees::get();
        return view("service.show", ['employees' => $employees]);
    }

    public function edit($id, Request $req)
    {
        $employee  = Employees::find($id);
        // view('Employee.edit', ['employee' => $employee]);
        return response()->json([
            'status' => 200,
            'Employee' => $employee

        ]);
    }


    public function update(Request $req)
    {
        $validater = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|min:3',
            'docID' => 'required',
            'image' => 'sometimes|image:jpeg,png,jpg,gif',
        ]);
        if ($validater->passes()) {
            $ids =  $req->empid;
            $employee  = Employees::find($ids);
            $employee->name = $req->name;
            $employee->email = $req->email;
            $employee->docID = $req->docID;
            if ($req->image) {
                $oldImage = $employee->image;
                $imageName = time() . '.' . $req->image->extension();
                $dest = public_path('uploads/employees/');
                $req->image->move($dest, $imageName); //This Will Save File to Public Folder)
                $employee->image = $imageName;
                $employee->save();
                File::delete($dest, $oldImage);
            }
            $employee->save();

            return back()->with('success', 'Employee Update Successfully');
        } else {
            #return With Error on Create Employee Form 
            return back()->with('error', 'Employee Update failed');
        }
    }
    public function destroy($id, Request $req)
    {
        $employee = Employees::find($id);
        $employee->delete();
        return redirect('show')->with('success', 'Employee Deleted Successfully');
    }


    public function showAjax()
    {
        $employees = Employees::all();
        // return $employees;
        return view("service.ajaxTable");
        //   return view("service.ajaxTable", ['employees' => $employees]);
    }

    public function showData(Request $request)
    {
        // SomeController.php



        if ($request->ajax()) {

            $data = Employees::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $actionBtn = '<button type="button" class="btn btn-success fas fa-edit"
                    //     data-toggle="modal" data-target="#modal-Edit" title="Edit" id="editBTN" value="' . $row->id . '"></button>
                    //     <button type="button" id="deleteBTN" class="btn btn-danger fas fa-trash-alt" value="' . $row->id . '" title="' . $row->id . '" ></button>';
                    $actionBtn = view('AjaxUtilty', compact('row'))->render();
                    return $actionBtn;
                    // return view('button')->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        /*For sending Normal Data for Showing Normal Table */
        // $data = Employees::latest()->get();
        // return $data;
    }

    // For Without Page Refresh Action

    public function updateWithoutReload($id, Request $req)
    {
        $validater = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|min:3',
            'docID' => 'required',
            'image' => 'sometimes|image:jpeg,png,jpg,gif',
        ]);
        if ($validater->passes()) {
            $ids =  $req->empid;
            $employee  = Employees::find($id);
            $employee->name = $req->name;
            $employee->email = $req->email;
            $employee->docID = $req->docID;
            if ($req->image) {
                $oldImage = $employee->image;
                $imageName = time() . '.' . $req->image->extension();
                $dest = public_path('uploads/employees/');
                $req->image->move($dest, $imageName); //This Will Save File to Public Folder)
                $employee->image = $imageName;
                $employee->save();
                File::delete($dest, $oldImage);
            }
            $employee->save();
            echo "Success";
            // return back()->with('success', 'Employee Update Successfully');
        } else {
            echo "failed";
            #return With Error on Create Employee Form 
            // return back()->with('error', 'Employee Update failed');
        }
    }



    // For Delete Employee Without Page-Reload

    public function destroyWithoutPage($id, Request $req)
    {
        $employee = Employees::find($id);
        $employee->delete();
        // return redirect('show')->with('success', 'Employee Deleted Successfully');
        echo "Success";
    }
}
