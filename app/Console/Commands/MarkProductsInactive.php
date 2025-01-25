<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class MarkProductsInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-products-inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark products inactive when the products category is Socks and the products were created more than 2 years ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twoYearsAgo = Carbon::now()->subYears(2);
			
		$affectedRows = Product::where('active', 'yes')  // Only select active products
            ->where('created_at', '<', $twoYearsAgo)  // Created more than 2 years ago
            ->whereHas('category', function ($query) {
                $query->where('name', 'Socks');  // Filter by category name 'Socks'
            })
            ->update(['active' => 'no']); // Update the result status to inactive

        $this->info("Updated $affectedRows products to inactive.");
    }
}
