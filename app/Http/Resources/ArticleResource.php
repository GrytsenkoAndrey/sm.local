<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title'        => $this->title,
            'slug'         => $this->slug,
            'subtitle'     => $this->subtitle,
            'image'        => $this->main_img,
            'content'      => $this->content,
            'category'     => (new CategoryResource($this->category)),
            'author_id'    => (new AuthorResource($this->author)),
            'tags'         => TagResource::collection($this->tags),
            'published_at' => $this->published_at->diffForHumans()
        ];
    }
}
