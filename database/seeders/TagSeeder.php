<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Tag::truncate();

        $dbStructureJson = file_get_contents(public_path() . "/feed.json");
        $dbStructureArray = json_decode($dbStructureJson, true);

        foreach ($dbStructureArray as $item) {
            foreach ($item['tags'] as $tag) {
                Tag::firstOrCreate([
                    'title' => $tag['name']
                ], [
                    'slug' => \Illuminate\Support\Str::slug($tag['name'])
                ]);
            }
        }
    }
}
