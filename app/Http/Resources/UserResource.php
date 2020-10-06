<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'gender' => $this->gender,
            'email'=> $this->email,
            'phone_no' => $this->phone_no,
            'profile_type' => $this->profile_type,
            'profile_id' => $this->profile_id,
            'profile_picture' => $this->profile_picture,
            'QRCode' => $this->QRCode,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'href' => [
                'address' => route('address.index', $this->id)
            ]
        ];
    }
}
