<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // adding the user connection with the post
            // $table->integer('user_id')->unsigned()->index();

            // but the next solution works with the foreign key
            // the foreignId will be looking at user_id as user[table_name] & id[table_col]
            // constrained means the foreign key is constrained here. hit records according to their constraints foreign key
            // onDelete('cascade') means that if any user is deleted then his posts will also be deleted in the database level
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
