<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = "Department";
    protected $primaryKey = "department_id";
    public  $timestamps = false;

    protected $fillable = [
      "name"
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function employee() {
        return $this->hasMany(Employee::class, "department_id");
    }

    public function doctor() {
        return $this->hasMany(Doctor::class,"department_id");
    }

}
