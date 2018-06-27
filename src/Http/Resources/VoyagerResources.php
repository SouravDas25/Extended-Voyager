<?php

namespace TCG\Voyager\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoyagerResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
