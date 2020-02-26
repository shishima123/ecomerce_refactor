<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;

class GetTopSelling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:topSelling';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all products top selling add to column top_selling on Products table';

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
     * @return mixed
     */
    public function handle()
    {
        /*set top_selling value in column Products = 0 */
        Product::where('top_selling', 1)->update(['top_selling' => 0]);

        /*Count all product ordered */
        $get_top_selling = Product::join('order_items', 'products.id', '=', 'order_items.product_id')->groupBy('order_items.product_id')->selectRaw('count(order_items.product_id) as total_items, products.id as product_id')->orderBy('total_items', 'DESC')->take(10)->get();

        /*Update all product best seller to column top_selling*/
        foreach ($get_top_selling as $item) {
            Product::find($item->product_id)->update(['top_selling' => 1]);
        }
    }
}
