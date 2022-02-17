<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Modules\Product\Entities\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {       
        $product =Product::All();
        // row[0] is the ID
                $product = $product->find($row[0]);
        // if product exists and the value also exists
                if ($product and $row[5]){
                    $product->update([
                        'price'=>$row[5]
                    ]);
                    return $product;
                }
    }
    
}
