<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['id', 'handle', 'title', 'body', 'vendor', 'type', 'tags', 'published', 'option1_name', 'option1_value', 'option2_name', 'option2_value', 'option3_name', 'option3_value', 'variant_SKU', 'variant_inventory_tracker', 'variant_inventory_qty', 'variant_inventory_policy', 'variant_fulfillment_service', 'variant_price', 'variant_compare_at_price', 'variant_requires_shipping', 'variant_taxable', 'variant_barcode', 'image_src', 'image_position', 'image_alt_text', 'gift_card', 'seo_title', 'seo_description', 'google_product_category', 'gender', 'age_group', 'mpn', 'adWords_grouping', 'adWords_labels', 'condition', 'custom_product', 'custom_label_0', 'custom_label_1', 'custom_label_3', 'custom_label_4', 'variant_image', 'variant_weight_unit', 'variant_tax_code', 'cost_per_item', 'userId', 'created_at', 'updated_at'];
    public $timestamps = false;
    protected $appends = ['product_wish_list_count','isCart'];

     public function gallery()
    {
        return $this->hasMany('App\Models\Gallery','product_id','id');
    }
    public function getProductWishlistCountAttribute()
    {
        return home_wish_list_count($this->id);
    }
    public function getIsCartAttribute()
    {   
        return is_product_cart($this->id);
    }
}
