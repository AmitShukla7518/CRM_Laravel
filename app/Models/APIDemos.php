<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIDemos extends Model
{
    use HasFactory;
    protected $fillable = ['EmployeeId','Name', 'Address', 'MobileNo', 'docID', 'docID', 'Email', 'password'];
}
