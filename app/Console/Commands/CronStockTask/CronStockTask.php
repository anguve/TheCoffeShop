<?php

namespace App\Console\Commands\CronStockTask;



use App\Mail\EmailStockMailable;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;




class CronStockTask extends Command
{ private static $response = array();
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Stock:Task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Constantly check product stocks and set a message if they are out of stock at 0';

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
        $product = Product::all();
        
        foreach ($product as $products) {
            Storage::append("archivo.txt", $products->stock);
            if($products->stock == 0){      
                Mail::to('andres.gutierrez.v@grupokonecta.com')->send(new  EmailStockMailable($product));
            }
        }
    }
}