<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'user_id' => $this['user_id'],
            'text' => $this['text'],
            'created_at' => $this->formatPostCreatedAt($this['created_at']),
            'user' => [
                'name' => $this['user']['name'],
                'username' => $this['user']['username'],
                'avatar' => url("img/cache/avatar/{$this['user']['avatar']}")
            ]
        ];
    }

    public function formatPostCreatedAt($value): string
    {
        $now    = now();
        $createdAt = Carbon::parse($value);

        $diff = $now->diffInSeconds($createdAt);
        $formattedDiff = '';

        if ($diff < 60) {
            $formattedDiff = "{$diff}s";
        } else if ($now->diffInDays($createdAt) >= 1) {
            $days = $now->diffInDays($createdAt);
            $formattedDiff = "{$days}d";
        } else if ($now->diffInHours($createdAt) >= 1) {
            $hours = $now->diffInHours($createdAt);
            $formattedDiff = "{$hours}h";
        } else if ($now->diffInMinutes($createdAt) >= 1) {
            $min = $now->diffInMinutes($createdAt);
            $formattedDiff = "{$min}m";
        }

        return $formattedDiff;
    }
}
