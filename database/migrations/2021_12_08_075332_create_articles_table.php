<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Article title');
            $table->string('slug')->unique()->comment('Article slug');
            $table->string('subtitle')->nullable()->comment('Lead text');
            $table->string('main_img')->nullable()->comment('Main article image');
            $table->text('content')->nullable()->comment('Article main content');
            $table->text('status')->default('draft')->comment('Article status: draft, published');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('author_id')->constrained();
            $table->timestamp('published_at')->nullable()->default(null)->comment('Publish date-time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
