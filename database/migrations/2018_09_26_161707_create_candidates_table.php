<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('company',100);
            $table->string('email', 100);
            $table->enum('qualification', ['Graduate','Post graduate']);
            $table->string('resume')->nullable();
            $table->string('hobbies');
            $table->timestamps();
            $table->unique(['email']);
            $table->index(['name', 'company', 'email', 'qualification', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
