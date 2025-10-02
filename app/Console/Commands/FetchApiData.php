<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use App\Models\Sale;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Income;

class FetchApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-api-data {--account=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $account_id = $this->option('account');
        echo($account_id . "\n");
        if ($account_id!= 10) exit;
        $url = getenv('WB_API_ADDRESS');
        $key = getenv('WB_API_KEY');
        
        $page = 1;
        $max_page = 1;
        $paths = ['sales', 'orders', 'stocks', 'incomes'];
        foreach($paths as $path){
            $page = 1; 
            do {
                echo("[Processing] " . $path . " page: " . $page . "\n");
                $decoded = json_decode($this->getResponse($url, $path, $page, $key));
                $data = $decoded -> data;
                $max_page = $decoded -> meta -> last_page;
                $this->fillData($data, $path);
                $page++;
            } while ($page < $max_page);
            echo("Done\n");
        }
        // print_r($decoded -> data);
        // print_r($response);
    }
    function getResponse($url, $path, $page, $key)
    {
        $today = date('Y-m-d');
        if ($path!='stocks'){
            $response = Http::get($url . $path, 
                ['key' => $key,
                'dateFrom' => '2020-08-01',
                'dateTo' => $today,
                'page' => $page,
            ]);
            return $response;
        } else{
            $response = Http::get($url . $path, 
                ['key' => $key,
                'dateFrom' => $today,
                'page' => $page,
            ]);
            return $response;
        }
        
    }

    function fillData($data, $path)
    {
        if ($path == 'sales'){
            foreach($data as $item){
                Sale::updateOrCreate(
                    [
                        'account_id' => $account_id,
                        'g_number' => $item->g_number,
                    ],
                    [
                        'date' => $item->date,
                        'last_change_date' => $item->last_change_date,
                        'supplier_article' => $item->supplier_article,
                        'tech_size' => $item->tech_size,
                        'barcode' => $item->barcode,
                        'total_price' => $item->total_price,
                        'discount_percent' => $item->discount_percent,
                        'is_supply' => $item->is_supply,
                        'is_realization' => $item->is_realization,
                        'promo_code_discount' => $item->promo_code_discount,
                        'warehouse_name' => $item->warehouse_name,
                        'country_name' => $item->country_name,
                        'oblast_okrug_name' => $item->oblast_okrug_name,
                        'region_name' => $item->region_name,
                        'income_id' => $item->income_id,
                        'sale_id' => $item->sale_id,
                        'odid' => $item->odid,
                        'spp' => $item->spp,
                        'for_pay' => $item->for_pay,
                        'finished_price' => $item->finished_price,
                        'price_with_disc' => $item->price_with_disc,
                        'nm_id' => $item->nm_id,
                        'subject' => $item->subject,
                        'category' => $item->category,
                        'brand' => $item->brand,
                        'is_storno' => $item->is_storno
                    ]
                );
            }
        } else if ($path == 'orders'){
            foreach($data as $item){
                Order::updateOrCreate(
                    [
                        'account_id' => $account_id,
                        'g_number' => $item->g_number,
                    ],
                    [
                        'date' => $item->date,
                        'last_change_date' => $item->last_change_date,
                        'supplier_article' => $item->supplier_article,
                        'tech_size' => $item->tech_size,
                        'barcode' => $item->barcode,
                        'total_price' => $item->total_price,
                        'discount_percent' => $item->discount_percent,
                        'warehouse_name' => $item->warehouse_name,
                        'oblast' => $item->oblast,
                        'income_id' => $item->income_id,
                        'odid' => $item->odid,
                        'nm_id' => $item->nm_id,
                        'subject' => $item->subject,
                        'category' => $item->category,
                        'brand' => $item->brand,
                        'is_cancel' => $item->is_cancel,
                        'cancel_dt' => $item->cancel_dt
                    ]
                );
            }
        } else if ($path == 'stocks'){
            foreach($data as $item){
                Stock::updateOrCreate(
                    [
                        'account_id' => $account_id,
                        'barcode' => $item->barcode,
                        'warehouse_name' => $item->warehouse_name
                    ],
                    [
                        'date' => $item->date,
                        'last_change_date' => $item->last_change_date,
                        'supplier_article' => $item->supplier_article,
                        'tech_size' => $item->tech_size,
                        'quantity' => $item->quantity,
                        'is_supply' => $item->is_supply,
                        'is_realization' => $item->is_realization,
                        'quantity_full' => $item->quantity_full,
                        'in_way_to_client' => $item->in_way_to_client,
                        'in_way_from_client' => $item->in_way_from_client,
                        'nm_id' => $item->nm_id,
                        'subject' => $item->subject,
                        'category' => $item->category,
                        'brand' => $item->brand,
                        'sc_code' => $item->sc_code,
                        'price' => $item->price,
                        'discount' => $item->discount
                    ]
                );
            }
        } else if ($path == 'incomes'){
            foreach($data as $item){
                Income::updateOrCreate(
                    [
                        'account_id' => $account_id,
                        'income_id' => $item->income_id,
                        'barcode' => $item->barcode
                    ],
                    [   
                        'number' => $item->number,
                        'date' => $item->date,
                        'last_change_date' => $item->last_change_date,
                        'supplier_article' => $item->supplier_article,
                        'tech_size' => $item->tech_size,
                        'quantity' => $item->quantity,
                        'total_price' => $item->total_price,
                        'date_close' => $item->date_close,
                        'warehouse_name' => $item->warehouse_name,
                        'nm_id' => $item->nm_id
                    ]
                );
            }            
        }
    }
}
