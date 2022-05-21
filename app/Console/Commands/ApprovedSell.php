<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Seller\Entities\SellRequest;
use Modules\Seller\Entities\Undelivered;

class ApprovedSell extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sell:approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $sell_request = SellRequest::select('id','is_approved', 'approved_date')->get();
        $undeli = Undelivered::all();
        foreach($undeli as $key=>$und){
            $request_product_update = Undelivered::where('req_id',$sell_request[$key]->id)
                                                    ->update(array(
                                                        'is_approved' => $sell_request[$key]->is_approved,        
                                                ));
        if( $sell_request[$key]->approved_date != null){
            $request_product_update = Undelivered::where('req_id',$sell_request[$key]->id)
                                                    ->update(array(
                                                        'created_at' => $sell_request[$key]->approved_date,
                                                ));
        }
        
        }
    }
}
