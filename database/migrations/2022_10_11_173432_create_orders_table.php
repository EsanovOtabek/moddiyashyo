<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('building_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('section_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('item_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('new_item_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status_1',['waiting','rejected','accepted'])->default('waiting');
            $table->integer('status_1_id')->nullable();
            $table->enum('status_2',['waiting','rejected','accepted'])->default('waiting');
            $table->integer('status_2_id')->nullable();
            $table->enum('status_3',['waiting','rejected','accepted'])->default('waiting');
            $table->integer('status_3_id')->nullable();
            $table->integer('quantity');
            $table->integer('new_quantity')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
