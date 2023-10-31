<?php

namespace App\Http\Resources;

use App\Models\Definition;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
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
            'word' => $this->word,
            'appropriate' => $this->appropriate,
            'definitions' => DefinitionResource::collection($this->whenLoaded('definitions'))
        ];
    }
}
