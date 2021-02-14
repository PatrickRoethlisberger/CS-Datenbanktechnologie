<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->float('price');
            $table->tinyInteger('duration');
            $table->tinyInteger('lots');
            $table->boolean('isInitialPlan');
            $table->boolean('isTerminatingPlan');
            $table->timestamps();
        });

        Artisan::call(
            'db:seed',
            [
                '--class' => 'PlanSeeder',
                '--force' => true
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
