<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules()
    {
        return [
            'file' => 'required|file'
        ];
    }
    // public function rules(): array
    // {
    // return [
    //     'handle'=> 'required',
    //     'title'=>'required',
    //     'body'=>'required',
    //     'vendor'=>'required',
    //     'type'=>'required',
    //     'tags'=>'required',
    //     'published'=>'required',
    //     'option1_name'=>'required',
    //     'option1_value'=>'required',
    //     'option2_name'=>'required',
    //     'option2_value'=>'required',
    //     'option3_name'=>'required',
    //     'option3_value'=>'required',
    //     'variant_sku'=>'required',
    //     'variant_grams'=>'required',
    //     'variant_inventory_tracker'=>'required',
    //     'variant_inventory_qty'=>'required',
    //     'variant_inventory_policy'=>'required',
    //     'variant_fulfillment_service'=>'required',
    //     'variant_price'=>'required',
    //     'variant_compare_at_price'=>'required',
    //     'variant_requires_shipping'=>'required',
    //     'variant_taxable'=>'required',
    //     'variant_barcode'=>'required',
    //     'image_src'=>'required',
    //     'image_position'=>'required',
    //     'image_alt_text'=>'required',
    //     'gift_card'=>'required',
    //     'seo_title'=>'required',
    //     'seo_description'=>'required',
    //     'google_product_category'=>'required',
    //     'gender'=>'required',
    //     'age_group'=>'required',
    //     'mpn'=>'required',
    //     'adWords_grouping'=>'required',
    //     'adWords_labels'=>'required',
    //     'condition'=>'required',
    //     'custom_product'=>'required',
    //     'custom_label_0'=>'required',
    //     'custom_label_1'=>'required',
    //     'custom_label_2'=>'required',
    //     'custom_label_3'=>'required',
    //     'custom_label_4'=>'required',
    //     'variant_image'=>'required',
    //     'variant_weight_unit'=>'required',
    //     'variant_tax_code'=>'required',
    //     'cost_per_item'=>'required',
    // ];
 
    // }
//     public function customValidationMessages()
//     {
//     return [
 
//                 #All Email Validation for Teacher Email
//                 'email.required'    => 'Teacher  Email must not be empty!',
//                 'email.email'       => 'Incorrect Teacher email address!',
//                 'email.unique'      => 'The Teacher email has already been used',
 
 
//                 #Max Lenght Validation
//                 'name.required'               => 'Teacher name must not be empty!',
//                 'name.max'                    => 'The maximun length of The Teacher name must not exceed :max',
//                 'dob'                         => 'Teacher Date of Birth must not be empty!',
//                 'sex.required'                => 'Teacher gender must not be empty!',
//                 'sex.max'                     => 'The maximun length of The Teacher gender must not exceed :max',
//                 'qualification.required'      => 'Teacher Qualification Field is required',
//                 'city.required'               => 'Citys must not be empty!',
//                 'city.max'                    => 'The maximun length of The city must not exceed :max',
//                 'country.required'            => 'Country must not be empty!',
//                 'country.max'                 => 'The maximun length of Country must not exceed :max',
//                 'address.required'            => 'Address  must not be empty!',
//                 'address.max'                 => 'The maximun length of The Address must not exceed :max',
 
 
//                 #Max Length with Contact Numeric Teacher
//                 'phone.required'      => 'Teacher contact must not be empty!',
//                 'phone.regex'         => 'Incorrect format of Teacher Contact',
 
 
//        ];
//   }
 
    public function model(array $row)
    {
       $products =Product::where('variant_SKU',$row[13])->first();
        if(empty($products)){
           
         Product::create([
            'handle'=>$row[0],
            'title'=>$row[1],
            'body'=>$row[2],
            'vendor'=>$row[3],
            'type'=>$row[4],
            'tags'=>$row[5],
            'published'=>$row[6],
            'option1_name'=>$row[7],
            'option1_value'=>$row[8],
            'option2_name'=>$row[9],
            'option2_value'=>$row[10],
            'option3_name'=>$row[11],
            'option3_value'=>$row[12],
            'variant_SKU'=>$row[13],
            'variant_grams'=>$row[14],
            'variant_inventory_tracker'=>$row[15],
            'variant_inventory_qty'=>$row[16],
            'variant_inventory_policy'=>$row[17],
            'variant_fulfillment_service'=>$row[18],
            'variant_price'=>$row[19],
            'variant_compare_at_price'=>$row[20],
            'variant_requires_shipping'=>$row[21],
            'variant_taxable'=>$row[22],
            'variant_barcode'=>$row[23],
            'image_src'=>$row[24],
            'image_position'=>$row[25],
            'image_alt_text'=>$row[26],
            'gift_card'=>$row[27],
            'seo_title'=>$row[28],
            'seo_description'=>$row[29],
            'google_product_category'=>$row[30],
            'gender'=>$row[31],
            'age_group'=>$row[32],
            'mpn'=>$row[33],
            'adWords_grouping'=>$row[34],
            'adWords_labels'=>$row[35],
            'condition'=>$row[36],
            'custom_product'=>$row[37],
            'custom_label_0'=>$row[38],
            'custom_label_1'=>$row[39],
            'custom_label_2'=>$row[40],
            'custom_label_3'=>$row[41],
            'custom_label_4'=>$row[42],
            'variant_image'=>$row[43],
            'variant_weight_unit'=>$row[44],
            'variant_tax_code'=>$row[45],
            'cost_per_item'=>$row[46],
        ]);
    }else{
        Product::find($products->id)->update([
            'handle'=>$row[0],
            'title'=>$row[1],
            'body'=>$row[2],
            'vendor'=>$row[3],
            'type'=>$row[4],
            'tags'=>$row[5],
            'published'=>$row[6],
            'option1_name'=>$row[7],
            'option1_value'=>$row[8],
            'option2_name'=>$row[9],
            'option2_value'=>$row[10],
            'option3_name'=>$row[11],
            'option3_value'=>$row[12],
            'variant_SKU'=>$row[13],
            'variant_grams'=>$row[14],
            'variant_inventory_tracker'=>$row[15],
            'variant_inventory_qty'=>$row[16],
            'variant_inventory_policy'=>$row[17],
            'variant_fulfillment_service'=>$row[18],
            'variant_price'=>$row[19],
            'variant_compare_at_price'=>$row[20],
            'variant_requires_shipping'=>$row[21],
            'variant_taxable'=>$row[22],
            'variant_barcode'=>$row[23],
            'image_src'=>$row[24],
            'image_position'=>$row[25],
            'image_alt_text'=>$row[26],
            'gift_card'=>$row[27],
            'seo_title'=>$row[28],
            'seo_description'=>$row[29],
            'google_product_category'=>$row[30],
            'gender'=>$row[31],
            'age_group'=>$row[32],
            'mpn'=>$row[33],
            'adWords_grouping'=>$row[34],
            'adWords_labels'=>$row[35],
            'condition'=>$row[36],
            'custom_product'=>$row[37],
            'custom_label_0'=>$row[38],
            'custom_label_1'=>$row[39],
            'custom_label_2'=>$row[40],
            'custom_label_3'=>$row[41],
            'custom_label_4'=>$row[42],
            'variant_image'=>$row[43],
            'variant_weight_unit'=>$row[44],
            'variant_tax_code'=>$row[45],
            'cost_per_item'=>$row[46],
        ]);
    }
       
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
