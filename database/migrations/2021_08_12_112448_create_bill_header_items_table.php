<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillHeaderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('bill_header_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id')->references('id')->on('bill_headers');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->decimal('rate', 8, 2);
            $table->string('qty');
            $table->decimal('base_amount', 8, 2);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_header_items');
    }
}
