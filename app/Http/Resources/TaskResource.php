<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'prioridad' => $this->prioridad,
            'estatus' => $this->estatus,
            'fechaVencimiento' => $this->fecha_vencimiento,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
