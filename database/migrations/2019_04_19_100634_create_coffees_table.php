<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoffeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coffees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        //dispatch info
            $table->string("wet");
            $table->integer("weight");
            $table->integer("sacks");
            $table->integer("stitchNo");
            $table->string("packDate");
            $table->string("region");
            $table->string("woreda");
            $table->string("kebele");
            $table->string("washingStation");
        //owner info
            $table->string("ownerName");
            $table->string("ownerPhone");
        //driver info
            $table->string("driverName");
            $table->string("driverPhone");
            $table->string("driverId");
            $table->string("licenceNum");
        //car info
            $table->string("typeOfCar");
            $table->string("plateNum");
            $table->Integer('cardinalNum');
            $table->boolean("dispatchFill");

            $table->string("specialty");
            $table->string("grade");
            $table->string("price");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coffees');
    }
}
