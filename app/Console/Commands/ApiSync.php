<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use Illuminate\Support\Facades\DB;

class ApiSync extends Command
{
    protected $signature = 'api:sync';
    protected $description = 'Стянуть данные из API';

    public function handle()
    {
        $service = new ApiService();
        $points = ['stocks', 'incomes', 'sales', 'orders'];
        
        foreach ($points as $point) {
            $this->info("Загрузка: {$point}...");
            $page = 1;

            do {
                $today = now()->format('Y-m-d');
                
                $params = [
                    'page' => $page,
                    'key' => 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie',
                    'limit' => 500
                ];

                if ($point === 'stocks') {
                    $params['dateFrom'] = $today;
                } else {
                    $params['dateFrom'] = '2023-01-01';
                    $params['dateTo'] = $today;
                }

                $response = $service->fetchData($point, $params);
                $items = $response['data'] ?? [];

                if (empty($items)) break;

                $chunk = [];

                foreach ($items as $item) {
                    $insertData = [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];

                        switch ($point) {
                            case 'stocks':
                                $insertData = array_merge($insertData, [
                                    'date'               => $item['date'] ?? null,
                                    'last_change_date'   => $item['last_change_date'] ?? null,
                                    'supplier_article'   => $item['supplier_article'] ?? null,
                                    'tech_size'          => $item['tech_size'] ?? null,
                                    'barcode'            => $item['barcode'] ?? null,
                                    'quantity'           => $item['quantity'] ?? null,
                                    'is_supply'          => $item['is_supply'] ?? null,
                                    'is_realization'     => $item['is_realization'] ?? null,
                                    'quantity_full'      => $item['quantity_full'] ?? null,
                                    'warehouse_name'     => $item['warehouse_name'] ?? null,
                                    'in_way_to_client'   => $item['in_way_to_client'] ?? null,
                                    'in_way_from_client' => $item['in_way_from_client'] ?? null,
                                    'nm_id'              => $item['nm_id'] ?? null,
                                    'subject'            => $item['subject'] ?? null,
                                    'category'           => $item['category'] ?? null,
                                    'brand'              => $item['brand'] ?? null,
                                    'sc_code'            => $item['sc_code'] ?? null,
                                    'price'              => $item['price'] ?? null,
                                    'discount'           => $item['discount'] ?? null,
                                ]);
                                break;

                            case 'incomes':
                                $insertData = array_merge($insertData, [
                                    'income_id'        => $item['income_id'] ?? null,
                                    'number'           => $item['number'] ?? null,
                                    'date'             => $item['date'] ?? null,
                                    'last_change_date' => $item['last_change_date'] ?? null,
                                    'supplier_article' => $item['supplier_article'] ?? null,
                                    'tech_size'        => $item['tech_size'] ?? null,
                                    'barcode'          => $item['barcode'] ?? null,
                                    'quantity'         => $item['quantity'] ?? null,
                                    'total_price'      => $item['total_price'] ?? null,
                                    'date_close'       => $item['date_close'] ?? null,
                                    'warehouse_name'   => $item['warehouse_name'] ?? null,
                                    'nm_id'            => $item['nm_id'] ?? null,
                                ]);
                                break;

                            case 'sales':
                                $insertData = array_merge($insertData, [
                                    'g_number'            => $item['g_number'] ?? null,
                                    'date'                => $item['date'] ?? null,
                                    'last_change_date'    => $item['last_change_date'] ?? null,
                                    'supplier_article'    => $item['supplier_article'] ?? null,
                                    'tech_size'           => $item['tech_size'] ?? null,
                                    'barcode'             => $item['barcode'] ?? null,
                                    'total_price'         => $item['total_price'] ?? null,
                                    'discount_percent'    => $item['discount_percent'] ?? null,
                                    'is_supply'           => $item['is_supply'] ?? null,
                                    'is_realization'      => $item['is_realization'] ?? null,
                                    'promo_code_discount' => $item['promo_code_discount'] ?? null,
                                    'warehouse_name'      => $item['warehouse_name'] ?? null,
                                    'country_name'        => $item['country_name'] ?? null,
                                    'oblast_okrug_name'   => $item['oblast_okrug_name'] ?? null,
                                    'region_name'         => $item['region_name'] ?? null,
                                    'income_id'           => $item['income_id'] ?? null,
                                    'sale_id'             => $item['sale_id'] ?? null,
                                    'odid'                => $item['odid'] ?? null,
                                    'spp'                 => $item['spp'] ?? null,
                                    'for_pay'             => $item['for_pay'] ?? null,
                                    'finished_price'      => $item['finished_price'] ?? null,
                                    'price_with_disc'     => $item['price_with_disc'] ?? null,
                                    'nm_id'               => $item['nm_id'] ?? null,
                                    'subject'             => $item['subject'] ?? null,
                                    'category'            => $item['category'] ?? null,
                                    'brand'               => $item['brand'] ?? null,
                                    'is_storno'           => $item['is_storno'] ?? null,
                                ]);
                                break;

                            case 'orders':
                                $insertData = array_merge($insertData, [
                                    'g_number'         => $item['g_number'] ?? null,
                                    'date'             => $item['date'] ?? null,
                                    'last_change_date' => $item['last_change_date'] ?? null,
                                    'supplier_article' => $item['supplier_article'] ?? null,
                                    'tech_size'        => $item['tech_size'] ?? null,
                                    'barcode'          => $item['barcode'] ?? null,
                                    'total_price'      => $item['total_price'] ?? null,
                                    'discount_percent' => $item['discount_percent'] ?? null,
                                    'warehouse_name'   => $item['warehouse_name'] ?? null,
                                    'oblast'           => $item['oblast'] ?? null,
                                    'income_id'        => $item['income_id'] ?? null,
                                    'odid'             => $item['odid'] ?? null,
                                    'nm_id'            => $item['nm_id'] ?? null,
                                    'subject'          => $item['subject'] ?? null,
                                    'category'         => $item['category'] ?? null,
                                    'brand'            => $item['brand'] ?? null,
                                    'is_cancel'        => $item['is_cancel'] ?? null,
                                    'cancel_dt'        => $item['cancel_dt'] ?? null,
                                ]);
                                break;
                        }
                        $chunk[] = $insertData;                        
                }
                if (!empty($chunk)) {
                    DB::table($point)->insert($chunk);
                }

                $this->info("Запрос к {$point}, страница {$page}. Найдено записей: " . count($items));

                $this->line("Страница {$page} готова");
                $page++;

            } while (count($items) >= 500);
        }

        $this->info('Готово! Все данные в БД.');
    }
}
