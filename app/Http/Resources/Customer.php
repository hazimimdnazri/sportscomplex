<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->r_user->id,
            'name' => $this->r_user->name,
            'email' => $this->r_user->email,
            'ic' => $this->ic,
            'gender' => $this->gender,
            'passport' => $this->passport,
            'nationality' => $this->nationality,
            'phone' => $this->phone,
            'dob' => $this->dob,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'state' => $this->state,
            'type' => $this->type,
            'membership' => $this->r_membership,

            'staff' => $this->r_user->r_staff ? [
                'id' => $this->r_user->r_staff->id,
                'staff_id' => $this->r_user->r_staff->staff_id,
                'company' => $this->r_user->r_staff->company
            ] : NULL,

            'student' => $this->r_user->r_student ? [
                'id' => $this->r_user->r_student->id,
                'staff_id' => $this->r_user->r_student->student_id,
                'company' => $this->r_user->r_student->institution
            ] : NULL
        ];
    }
}
