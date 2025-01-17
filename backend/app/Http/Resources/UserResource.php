<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (integer)$this->id,
            'firstname' => (string)$this->firstname,
            'lastname' => (string)$this->lastname,
            'email' => (string)$this->email,
            'created_at' => (string)$this->created_at,
        ];
    }
}
