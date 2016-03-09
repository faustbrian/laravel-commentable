<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

/**
 * Class CreateCommentsTable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class CreateCommentsTable extends Migration
{
    /**
     *
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('body');
            $table->morphs('commentable');
            $table->morphs('creator');
            NestedSet::columns($table);
            $table->timestamps();
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
