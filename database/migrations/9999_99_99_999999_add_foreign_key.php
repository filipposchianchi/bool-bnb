<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // utenti appartamenti (1 - molti)
        Schema::table('apartments', function (Blueprint $table) {
            $table->bigInteger('user_id') ->unsigned() -> index();
            $table->foreign('user_id', 'apartments_users')->references('id')->on('users');
        });

        // appartmenti - messaggi (1 - molti)
        Schema::table('messages', function (Blueprint $table) {
            $table->bigInteger('apartment_id') ->unsigned() -> index();
            $table->foreign('apartment_id', 'messages_apartments')->references('id')->on('apartments');
        });
        // appartamenti - PacchettiProm (1 - molti)
        // Schema::table('promos', function (Blueprint $table) {
        //     $table->bigInteger('apartment_id') ->unsigned() -> index();
        //     $table->foreign('apartment_id', 'promos_apartments')->references('id')->on('apartments');
        // });

        //appartamenti - servizi (molti - molti)
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->bigInteger('apartment_id') ->unsigned() -> index();
            $table->foreign('apartment_id', 'apartments_services_apartment')->references('id')->on('apartments');

            $table->bigInteger('service_id') ->unsigned() -> index();
            $table->foreign('service_id', 'apartments_services_service')->references('id')->on('services');
        });

        //appartamenti - promo (molti - molti)
        Schema::table('apartment_promo', function (Blueprint $table) {
            $table->bigInteger('apartment_id') ->unsigned() -> index();
            $table->foreign('apartment_id', 'apartments_promos_apartment')->references('id')->on('apartments');

            $table->bigInteger('promo_id') ->unsigned() -> index();
            $table->foreign('promo_id', 'apartments_promos_promo')->references('id')->on('promos');
        });
        // appartamenti - servizi (1 - 1)
    //     Schema::table('services', function (Blueprint $table) {
    //         $table->bigInteger('apartment_id') ->unsigned() -> index();
    //         $table->foreign('apartment_id', 'service_apartment')->references('id')->on('apartments');
    //     });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function(Blueprint $table) {
            $table->dropForeign('apartments_users');
            $table->dropColumn('user_id');
        });
        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign('messages_apartments');
            $table->dropColumn('apartment_id');
        });
        
        Schema::table('apartment_service', function(Blueprint $table) {
            $table->dropForeign('apartments_services_apartment');
            $table->dropForeign('apartments_services_service');
            $table->dropColumn('apartment_id');
            $table->dropColumn('service_id');
        });

        Schema::table('apartment_promo', function(Blueprint $table) {
            $table->dropForeign('apartments_promos_apartment');
            $table->dropForeign('apartments_promos_promo');
            $table->dropColumn('apartment_id');
            $table->dropColumn('promo_id');
        });
        // Schema::table('services', function(Blueprint $table) {
        //     $table->dropForeign('service_apartment');
        //     $table->dropColumn('apartment_id');
        // });
    }
}
