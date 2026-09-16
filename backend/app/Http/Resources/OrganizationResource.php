<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'organization_name' => $this->organizationProfile->organization_name,
            'organization_type' => $this->organizationProfile->organization_type,
            'description' => $this->organizationProfile->organization_description,
        ];
    }
}
