<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Department;
use App\Models\Manufacturer;
use App\Models\Product;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use LimitIterator;
use SplFileObject;

class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import .csv file';

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
     * @return void
     */
    public function handle()
    {
        $file_path = $this->argument('file');

        if (!file_exists($file_path)) {
            $this->error('File does not exist.');
            return;
        }

        try {
            $file = new SplFileObject($file_path);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD | SplFileObject::DROP_NEW_LINE);
            $it = new LimitIterator($file, 1);

            foreach ($it as $key => $value) {
                list($product_number, $category_name, $department_name, $manufacturer_name, $upc, $sku, $regular_price, $sale_price, $description) = $value;
                $cat_id = Category::firstOrCreate(['name' => $category_name])->id;
                $dep_id = Department::firstOrCreate(['name' => $department_name])->id;
                $man_id = Manufacturer::firstOrCreate(['name' => $manufacturer_name])->id;

                Product::create([
                    'cat_id' => $cat_id,
                    'dep_id' => $dep_id,
                    'man_id' => $man_id,
                    'product_number' => $product_number,
                    'upc' => $upc,
                    'sku' => $sku,
                    'regular_price' => $regular_price,
                    'sale_price' => $sale_price,
                    'description' => $description
                ]);
            }

            $this->info('You have successfully imported data!');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->error('Could not import data');
        }
    }
}
