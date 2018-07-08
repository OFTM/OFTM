<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TournamentRessource extends JsonResource
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
            'sex' => $this->sex,
            'weaponclass' => $this->weaponclass,
            'ageclass' => $this->ageclass,
            'ruleset' => $this->ruleset
        ];
    }
}
