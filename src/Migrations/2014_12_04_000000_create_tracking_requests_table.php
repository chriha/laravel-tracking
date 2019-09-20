<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingRequestsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'tracking_requests', function( Blueprint $table )
        {
            $table->bigIncrements( 'id' );
            $table->string( 'method' )->default( 'GET' );
            $table->string( 'scheme' );
            $table->string( 'host' );
            $table->string( 'path' )->nullable();
            $table->string( 'query' )->nullable();
            $table->text( 'content' )->nullable();
            $table->string( 'content_type' )->nullable();
            $table->string( 'referer' )->nullable();
            $table->enum( 'xhr', [ 'true', 'false' ] )->default( 'false' );

            $table->unsignedBigInteger( 'user_id' )->nullable();
            $table->string( 'ip' )->nullable();
            $table->string( 'agent' )->nullable();
            $table->string( 'locale' )->nullable();

            $table->timestamp( 'created_at' );

            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'tracking_requests', function( Blueprint $table )
        {
            $table->dropForeign( 'tracking_requests_user_id_foreign' );
        } );

        Schema::dropIfExists( 'tracking_requests' );
    }
}
