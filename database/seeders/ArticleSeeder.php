<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Article::truncate();
        Author::truncate();
        Category::truncate();

        $dbStructureJson = file_get_contents(public_path() . "/feed.json");
        $dbStructureArray = json_decode($dbStructureJson, true);

        # init arrays
        $tags = [];

        foreach ($dbStructureArray as $item) {
            # categories
            if ($item['categories']['primary']) {
                $category = \App\Models\Category::firstOrCreate([
                    'title' => $item['categories']['primary']
                ], [
                    'slug' => \Illuminate\Support\Str::slug($item['categories']['primary'])
                ]);
            }
            # authors
            $author = \App\Models\Author::firstOrCreate([
                'name' => $item['authors'][0]['name']
            ]);
            # tags
            foreach ($item['tags'] as $tag) {
                $tags[] = \App\Models\Tag::whereTitle($tag['name'])->first()->id;
            }

            /**
             * one way it's make insert an array with all articles BUT
             *     after that somehow you have to synchronize articles <=> tags
             * second way it's just insert each separate article and
             *     synchronize tags at once
             */

            $article = \App\Models\Article::create([
                'title'        => $item['title'],
                'slug'         => $item['slug'],
                'subtitle'     => $item['subtitle'],
                'main_img'     => count($item['media']) > 0 ? $item['media'][0]['media']['attributes']['url'] : null,
                'content'      => count($item['content']) > 0 ? $item['content'][0]['content'] : null,
                'status'       => $item['properties']['status'],
                'category_id'  => $category->id,
                'author_id'    => $author->id,
                'published_at' => date('Y-m-d H:i:s', strtotime($item['properties']['published']))
            ]);

            $article->tags()->sync($tags);
            $tags = [];
        }
    }
}
