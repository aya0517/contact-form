<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('first_name', 255)->nullable(false);
            $table->string('last_name', 255)->nullable(false);
            $table->tinyInteger('gender')->nullable(false)->comment('1: 男性, 2: 女性, 3: その他');
            $table->string('email', 255)->nullable(false); // unique 制約を削除
            $table->string('tel', 255)->nullable(false);
            $table->string('address', 255)->nullable(false);
            $table->string('building', 255)->nullable();
            $table->text('detail')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIfExists('contacts');
        });
    }

}
