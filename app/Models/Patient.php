<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = "Patient";
    protected $primaryKey = "patient_id";

    public $timestamps = false;
    protected $fillable = [
      "name",
      "sex",
      "address",
      "phoneNumber",
      "blood",
      "age",
      "patientsStatements",
      "doctor_id",
      "email",
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];


    public function doctor() {
        return $this->belongsTo(Doctor::class,"doctor_id","doctor_id");
    }
}
