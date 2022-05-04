<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "department_id" => $this->department_id,
            "name" => $this->name,
            "employees" => new EmployeeResource($this->employee),
            "doctors" => new DoctorResource($this->doctor)
        ];
    }
}
