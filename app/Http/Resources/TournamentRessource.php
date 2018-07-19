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
            'sexes' => $this->sexes,
            'weaponclass' => $this->weaponclass,
            'ageclasses' => $this->ageclasses,
            'ruleset' => $this->ruleset
        ];
    }
}
