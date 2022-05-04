<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = "Doctor";

    public function department() {
        $this->belongsTo(Department::class, "department_id","department_id");
    }
}
