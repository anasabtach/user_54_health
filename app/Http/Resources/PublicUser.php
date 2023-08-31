<?php

namespace App\Http\Resources;

use App\Helpers\CustomHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PublicUser extends JsonResource
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
           'id'               => $this->id,
           'name'             => $this->name,
           'business_name'    => $this->business_name,
           'slug'             => $this->slug,
           'image_url'        => !empty($this->image_url) ? Storage::url($this->image_url) : URL::to('images/user-placeholder.jpg'),
           'blur_image'       => !empty($this->image_url) ? $this->blur_image : 'LKQ,L0of~qof_3fQ%Mj[WBfQM{fQ',
           'category'         => $this->whenLoaded('category'),
           'country'          => $this->whenLoaded('country'),
           'state'            => $this->whenLoaded('state'),
           'city'             => $this->whenLoaded('city'),
           'zipcode'          => $this->zipcode,
           'address'          => $this->address,
           'latitude'         => $this->latitude,
           'longitude'        => $this->longitude,
       ];
    }
}
