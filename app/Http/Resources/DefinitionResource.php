<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefinitionResource extends JsonResource
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
            'wordId' => $this->word_id,
            'definition' => $this->definition,
            'userID' => $this->user_id,
            'wordTypeId' => $this->word_type_id,
            'appropriate' => $this->appropriate,
        ];
    }
}
