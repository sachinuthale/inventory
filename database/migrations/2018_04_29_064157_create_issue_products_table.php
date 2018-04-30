<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consumerId');
            $table->integer('productId');
            $table->integer('issuedQuantity');
            $table->dateTime('issued_at');
            $table->dateTime('returned_at');
            $table->integer('returnFlag');
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
        Schema::dropIfExists('issue_products');
    }
}
