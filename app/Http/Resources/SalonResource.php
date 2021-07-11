<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		$data['id'] = $this->id;
		$data['salon_name'] = $this->salon_name;
		$data['salon_description'] = $this->salon_description;
		$data['salon_address'] = $this->salon_address;
		$data['longitude'] = $this->longitude;
		$data['latitude'] = $this->latitude;
		return $data;
	}
}
