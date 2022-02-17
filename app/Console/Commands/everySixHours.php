<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Seller\Entities\RequestProduct;
use Modules\Product\Entities\Product;


class everySixHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Null Price in Request Product will be updated';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $request_products = RequestProduct::where('unit_price', '=', NULL )->select('id', 'product_id')->get();
         
        foreach($request_products as $key=>$request_product){
            $products = Product::where('id', $request_products[$key]->product_id)->select( 'price', 'production_price')->get();
            $request_product_update = RequestProduct::where('id',$request_products[$key]->id)
                ->update(array('unit_price' => $products[0]->price, 'production_price' => $products[0]->production_price));
        }
    }
}
