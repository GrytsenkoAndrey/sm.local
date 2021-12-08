<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $sortField = request('sort_field', 'created_at');
        if (!in_array($sortField, ['title', 'published_at'])) {
            $sortField = 'published_at';
        }
        $sortDirection = request('sort_direction', 'desc');
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $articles = Article::when(request('category_id', '') != '', function ($q) {
                $q->where('category_id', request('category_id'));
            })
            ->when(request('search', '') != '', function ($q) {
                $q->where('title', 'LIKE', '%' . request('search') . '%');
            })
            ->orderBy($sortField, $sortDirection)->paginate();

        return ArticleResource::collection($articles);
    }

    /**
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return (new ArticleResource($article));
    }
}
