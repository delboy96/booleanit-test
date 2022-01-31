<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use SplFileObject;
use function PHPUnit\Framework\fileExists;
use function PHPUnit\Framework\throwException;

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

        $this->info('You have successfully imported data!');

        if (!file_exists($file_path)) {
            $this->error('File does not exist.');
            return;
        }

//        try {
//
//            $file = new SplFileObject($file_path);
//            $file->setFlags(SplFileObject::READ_CSV);
//
//            foreach ($file as $key => $value) {
//                list($product_number, $category_name, $department_name, $manufacturer_name, $upc, $sku, $regular_price, $sale_price, $description) = $value;
//                Category::create(['name' => $category_name]);
//                Product::create([
//                    'cat_id' => $cat_id,
//                    'product_number' => $product_number,
//                    'category_name' => $category_name,
//                    'department_name' => $department_name,
//                    'manufacturer_name' => $manufacturer_name,
//                    'upc' => $upc,
//                    'sku' => $sku,
//                    'regular_price' => $regular_price,
//                    'sale_price' => $sale_price,
//                    'description' => $description
//                ]);
//            }
//        } catch (Exception $e) {
//            dd($e);
//        }

//        if (file_exists($path)) {
//            try {
//                $file = new SplFileObject($path);
//                $file->setFlags(SplFileObject::READ_CSV);
//
//                foreach ($file as $key => $value) {
//                    list($product_number, $category_name, $department_name, $manufacturer_name, $upc, $sku, $regular_price, $sale_price, $description) = $value;
//                    Category::create(['name' => $category_name]);
//                    Product::create(['cat_id' => , 'product_number' => $product_number, 'category_name' => $category_name, 'department_name' => $department_name, 'manufacturer_name' => $manufacturer_name, 'upc' => $upc, 'sku' => $sku, 'regular_price' => $regular_price, 'sale_price' => $sale_price, 'description' => $description]);
//                }
//
//                print('Data saved!');
//            } catch (Exception $e) {
//                Log::error($e->getMessage());
//                print ('Error.');
//            }
//        }
    }
}
