<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatatanHaidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "cycle_length" => $this->cycle_length,
            "period_length" => $this->period_length,
            "start_prediction_date" => $this->start_prediction_date,
            "end_prediction_date" => $this->end_prediction_date,
            "status" => $this->status,
            "reminder_active" => $this->reminder_active,
            "user" => $this->user
        ];
    }
}
