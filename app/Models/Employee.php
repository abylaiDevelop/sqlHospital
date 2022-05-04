<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Employee extends Model
{
    use HasFactory;

    protected $table = "Employee";
    protected $primaryKey = "emp_id";

    public function department()
    {
        return $this->belongsTo(Department::class,"department_id","department_id");
    }
}
