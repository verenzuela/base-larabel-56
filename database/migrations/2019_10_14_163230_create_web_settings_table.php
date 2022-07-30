<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->boolean('randomize_homepage_slideshow')->default(false)->nullable();
            $table->string('adm_url', 100);
            $table->string('web_url', 100)->nullable();
            $table->string('api_url', 100)->nullable();
            $table->string('supplier_name', 255)->nullable();
            $table->string('supplier_address', 255)->nullable();
            $table->string('supplier_bank_account', 45)->nullable();
            $table->string('supplier_tax_id', 45)->nullable();
            $table->string('supplier_bank_name', 60)->nullable();
            $table->string('supplier_routing_number', 60)->nullable();
            $table->text('booking_policy_general')->nullable();
            $table->text('booking_policy_non_refundable')->nullable();
            $table->text('booking_policy_refundable')->nullable();
            //$table->text('post_stay_url_questionnaire')->nullable();
            //$table->text('booking_confirm_url_questionnaire')->nullable();
            //$table->text('booking_cancel_url_questionnaire')->nullable();

            $table->string('api_token_shopilite', 60)->nullable();
            $table->string('store_base_code_branch', 20)->nullable();
            $table->string('branch_hash_code', 50)->nullable();
            $table->enum('store_base_code_status', ['updated', 'outdated', 'updating', 'in-progress'])->nullable();

            $table->timestamps();

            $table->index('domain_id');
            $table->unique('domain_id');

            $table->foreign('domain_id')->references('id')->on('domains')->onUpdate('restrict')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_settings');
    }
}
