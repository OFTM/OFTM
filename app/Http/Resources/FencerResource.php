<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FencerResource extends JsonResource
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
            'person' => $this->person->load('sex')
        ];
    }
}
