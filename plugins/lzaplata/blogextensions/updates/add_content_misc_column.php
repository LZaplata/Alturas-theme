<?php

namespace LZaplata\BlogExtensions\updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddContentMiscColumn extends Migration
{
    public function up()
    {
        if (Schema::hasColumn("rainlab_blog_posts", "content_misc")) {
            return;
        }

        Schema::table("rainlab_blog_posts", function ($table) {
            $table->text("content_misc")->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn("rainlab_blog_posts", "content_misc")) {
            Schema::table("rainlab_blog_posts", function ($table) {
                $table->dropColumn("content_misc");
            });
        }
    }
}
