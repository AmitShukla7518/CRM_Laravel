<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = ['EmployeeID', 'name', 'email', 'docID', 'address', 'image', 'password', 'country', 'state'];

    function notes()
    {
        return $this->hasMany(Employee::class);
    }
}
