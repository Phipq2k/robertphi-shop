<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCategoryPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_category_post', function (Blueprint $table) {
            $table->increments('cate_post_id');
            $table->string('cate_post_name');
            $table->string('cate_post_status',10);
            $table->string('cate_post_slug',100);
            $table->string('cate_post_slug');
            $table->string('cate_post_meta_keywords');
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
        Schema::dropIfExists('tbl_category_post');
    }
}
