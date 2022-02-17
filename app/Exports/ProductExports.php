<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\Product\Entities\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

// class ProductExports implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         return new Product([
//             'id'  => $row['id'],
//             'date' => $row['date'],
//             'product_id' => $row['product_id'],
//             'product_name' => $row['product_name'],
//             'product_model' => $row['product_model'],
//             'is_set' => $row['is_set'],
//             'is_head' => $row['is_head'],
//             'head_code' => $row['head_code'],
//             'set_id' => $row['set_id'],
//             'combo_ids' => $row['combo_ids'],
//             'product_details' => $row['product_details'],
//             'image' => $row['image'],
//             'price' => $row['price'],
//             'production_price' => $row['production_price'],
//             'tax' => $row['tax'],
//             'category_id' => $row['category_id'],
//             'unit_id' => $row['unit_id'],
//             'supplier_id' => $row['supplier_id'],
//             'company_id' => $row['company_id'],
//             'status' => $row['status'],
//             'created_at' => $row['created_at'],
//             'updated_at' => $row['updated_at'],
            
//         ]);
//     }
// }



class ProductExports implements FromCollection,WithHeadings
{
    public function collection()
    {
        $type =Product::Select(
        'id',
       // 'date',
        'product_id',
        'product_name',
        'product_model',
        //'is_set',
        //'is_head',
        'head_code',
       // 'set_id',
       // 'combo_ids',
        //'product_details',
       // 'image',
        'price',
      //  'production_price'
      //  'tax',
      //  'category_id',
       // 'unit_id',
      //  'supplier_id',
       // 'company_id',
       // 'status'
    )->get();

        return $type ;
    }
     public function headings(): array
    {
        return [
            'id',
            //'date',
            'product_id',
            'product_name',
            'product_model',
           // 'is_set',
           // 'is_head',
            'head_code',
            //'set_id',
           // 'combo_ids',
           // 'product_details',
           // 'image',
            'price',
          //  'production_price'
           // 'tax',
           // 'category_id',
          //  'unit_id',
          //  'supplier_id',
           // 'company_id',
           // 'status'

        ];
    }
}