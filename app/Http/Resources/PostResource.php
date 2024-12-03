<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => \Illuminate\Support\Str::limit($this->content, 50),
            'category_id' => $this->category_id,
            'category' => $this->category->name,
            'users' => $this->users,
            'image' => $this->getFirstMediaUrl() ?? 'https://via.placeholder.com/640x480.png/CCCCCC?text=animals+jpg+quos',
            'likes_count'=> $this->users()->count(),
            'images' => $this->media,
            'created_at' => $this->created_at->toDateString()
        ];
    }
}
