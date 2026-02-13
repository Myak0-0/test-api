<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = ['stocks', 'incomes', 'sales', 'orders'];

        foreach ($tables as $tableName) {
            switch ($tableName) {
                case 'stocks':
                    Schema::create($tableName, function (Blueprint $table) {
                        $table->id();
                        $table->date('date')->nullable();
                        $table->date('last_change_date')->nullable();
                        $table->string('supplier_article')->nullable();
                        $table->string('tech_size')->nullable();
                        $table->string('barcode')->nullable();
                        $table->integer('quantity')->nullable();
                        $table->boolean('is_supply')->nullable();
                        $table->boolean('is_realization')->nullable();
                        $table->integer('quantity_full')->nullable();
                        $table->string('warehouse_name')->nullable();
                        $table->integer('in_way_to_client')->nullable();
                        $table->integer('in_way_from_client')->nullable();
                        $table->bigInteger('nm_id')->nullable();
                        $table->string('subject')->nullable();
                        $table->string('category')->nullable();
                        $table->string('brand')->nullable();
                        $table->string('sc_code')->nullable();
                        $table->decimal('price', 15, 2)->nullable();
                        $table->decimal('discount', 15, 2)->nullable();
                        $table->timestamps();
                    });
                    break;

                case 'incomes':
                    Schema::create($tableName, function (Blueprint $table) {
                        $table->id();
                        $table->bigInteger('income_id')->nullable();
                        $table->string('number')->nullable();
                        $table->date('date')->nullable();
                        $table->date('last_change_date')->nullable();
                        $table->string('supplier_article')->nullable();
                        $table->string('tech_size')->nullable();
                        $table->string('barcode')->nullable();
                        $table->integer('quantity')->nullable();
                        $table->decimal('total_price', 15, 2)->nullable();
                        $table->date('date_close')->nullable();
                        $table->string('warehouse_name')->nullable();
                        $table->bigInteger('nm_id')->nullable();
                        $table->timestamps();
                    });
                    break;

                case 'sales':
                    Schema::create($tableName, function (Blueprint $table) {
                        $table->id();
                        $table->string('g_number')->nullable();
                        $table->date('date')->nullable();
                        $table->date('last_change_date')->nullable();
                        $table->string('supplier_article')->nullable();
                        $table->string('tech_size')->nullable();
                        $table->string('barcode')->nullable();
                        $table->decimal('total_price', 15, 2)->nullable();
                        $table->decimal('discount_percent', 8, 2)->nullable();
                        $table->boolean('is_supply')->nullable();
                        $table->boolean('is_realization')->nullable();
                        $table->decimal('promo_code_discount', 15, 2)->nullable();
                        $table->string('warehouse_name')->nullable();
                        $table->string('country_name')->nullable();
                        $table->string('oblast_okrug_name')->nullable();
                        $table->string('region_name')->nullable();
                        $table->bigInteger('income_id')->nullable();
                        $table->string('sale_id')->nullable();
                        $table->string('odid')->nullable();
                        $table->integer('spp')->nullable();
                        $table->decimal('for_pay', 15, 2)->nullable();
                        $table->decimal('finished_price', 15, 2)->nullable();
                        $table->decimal('price_with_disc', 15, 2)->nullable();
                        $table->bigInteger('nm_id')->nullable();
                        $table->string('subject')->nullable();
                        $table->string('category')->nullable();
                        $table->string('brand')->nullable();
                        $table->boolean('is_storno')->nullable();
                        $table->timestamps();
                    });
                    break;

                case 'orders':
                    Schema::create($tableName, function (Blueprint $table) {
                        $table->id();
                        $table->string('g_number')->nullable();
                        $table->dateTime('date')->nullable();
                        $table->date('last_change_date')->nullable();
                        $table->string('supplier_article')->nullable();
                        $table->string('tech_size')->nullable();
                        $table->string('barcode')->nullable();
                        $table->decimal('total_price', 15, 2)->nullable();
                        $table->decimal('discount_percent', 8, 2)->nullable();
                        $table->string('warehouse_name')->nullable();
                        $table->string('oblast')->nullable();
                        $table->bigInteger('income_id')->nullable();
                        $table->string('odid')->nullable();
                        $table->bigInteger('nm_id')->nullable();
                        $table->string('subject')->nullable();
                        $table->string('category')->nullable();
                        $table->string('brand')->nullable();
                        $table->boolean('is_cancel')->nullable();
                        $table->dateTime('cancel_dt')->nullable();
                        $table->timestamps();
                    });
            }
        }
    }   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('orders');
    }
}
