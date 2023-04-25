<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\manageEmp;
use App\Http\Controllers\utilityController;
use App\http\Controllers\dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [dashboard::class, 'dashboard'])->name('dashboard');
    Route::post('/importExl', [dashboard::class, 'importExl'])->name('importExl');
    Route::get('create', [manageEmp::class, 'CreateEMP'])->name('create');
    Route::post('create', [manageEmp::class, 'store'])->name('create');
    Route::get('show', [manageEmp::class, 'showEmp'])->name('show');
    Route::get('Show-employee/{EmployeeID}', [manageEmp::class, 'Edit'])->name('edit1');
    Route::any('edit-Employee', [manageEmp::class, 'update'])->name('update'); // Manual Way.......
    Route::any('edit-Employee/{EmployeeID}', [manageEmp::class, 'updateWithoutReload'])->name('update-Emp'); // Without Page Refresh
    Route::delete('Delete-employee/{EmployeeID}', [manageEmp::class, 'destroy'])->name('manageEmp.destroy');
    Route::delete('DLT-EMP/{EmployeeID}', [manageEmp::class, 'destroyWithoutPage'])->name('MNG.destroyByID');
    Route::get('logout', [utilityController::class, 'logout'])->name('logout');
    Route::get('ajax-data-table', [manageEmp::class, 'showAjax'])->name('ajax-data-table');
    Route::get('ajax-data', [manageEmp::class, 'showData'])->name('ajax-data');
});

// Route::get('/create', function () {
//     return view('service.create');
// })->name('create');
