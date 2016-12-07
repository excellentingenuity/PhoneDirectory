<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_events', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('aggregate');
            $table->string('aggregate_id');
            $table->json('payload');
            $table->string('event');
            $table->timestamp('fired_at');
            $table->increments('order');
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
        // TODO: remove later to avoid the events ever being deleted
        Schema::dropIfExists('domain_events');
    }
}
