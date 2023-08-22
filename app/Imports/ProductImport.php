<?php

namespace App\Imports;

use App\Product;

use App\MallProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Brand;
use App\Color;
use App\Category;
use App\MallCategory;
use App\Subcategory;
use App\ProductImage;
use App\MallProductImage;
use App\ProductInformation;
use App\MallProductInformation;
use App\Mall;
use DB;
use Toastr;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows){

        $not__insert_data = array();
        $insert_data = array();
        $message="Product Added Successfully!!!";
        foreach ($rows as $key => $row) {
            if(!empty($row[' mall_ username'])){
                $user = DB::table('users')->select('id')->where('user_name','LIKE','%'.$row[' mall_ username'].'%')->first();
                if(empty($user)){
                    Toastr::error("Mall not associate with this  mall_ username", 'Warning',["positionClass" => "toast-top-right"]);
                    return redirect()->back();
                }
                $mall = DB::table('malls')->where('user_id',$user->id)->first();
                if(!empty($mall)){
                    $product = MallProduct::where('Product_ID',$row['product_id'])->get();
                    $brand = Brand::where('brand_name','LIKE','%'.$row['brand_name'].'%')->first();
                    $colors = Color::where('name','LIKE','%'.$row['color'].'%')->first();
                    $category = DB::table('mall_categories')
                                ->select('categories.*','mall_categories.mall_id')
                                ->join('categories','categories.id','=','mall_categories.category_id')
                                ->where('mall_categories.mall_id',$mall->id)
                                ->where('categories.name','LIKE','%'.$row['product_category_name'].'%')
                                // ->where('categories.brand_id',$brand->id)
                                ->first();
                   
                    $sub_category = Subcategory::where('subcategory_name','LIKE','%'.$row['product_sub_category_name'].'%')->first();
                    if(count($product)==0){
                
                        $new_product =  new MallProduct;
                        $new_product->Product_ID    = $row['product_id'];
                        $new_product->productname   = $row['product_name']; 
                        $new_product->mall_id   = $mall->id; 
                        $new_product->brand_id   = !empty($brand)?$brand->id:0; 
                        $new_product->category_id   = !empty($category)?$category->id:0;
                        $new_product->subcategory_id   = !empty($sub_category)?$sub_category->id:0; 
                        $new_product->color_id   = !empty($colors)?$colors->id:0; 
                        $new_product->product_id_link_to= $row['product_id_link_to'];
                        $new_product->cost= $row['cost'];
                        $new_product->size= $row['size'];
                        $new_product->tax_type= $row['tax_type'];
                        $new_product->tax= $row['tax'];
                        $new_product->discount= $row['discount'];
                        $new_product->product_title= $row['product_title'];
                        $new_product->maximum_order= $row['maximum_order'];
                        $new_product->rating= $row['rating'];
                        $new_product->shipping_type= $row['shipping_type'];
                        $new_product->productdescription= $row['blog_description'];
                        $new_product->shipping_charge= $row['shipping_charge'];
                        $new_product->shipping_time= $row['shipping_time'];
                        $new_product->image= $row['main_image'];
                        $new_product->save();
                        $product_id = DB::getPdo()->lastInsertId();
                        $sub_images = explode(',',$row['sub_images']);
                        $product_spectification_key = explode(',',$row['product_spectification_key']);
                        $product_spectification_value = explode(',',$row['product_spectification_value']);
                        if(is_array($sub_images)){
                            foreach ($sub_images as $key => $image) {
                                $product_images = new MallProductImage;
                                $product_images->mall_product_id = $product_id;
                                $product_images->product_image = $image;
                                $product_images->save();
                            }
                        }
                        if(is_array($product_spectification_key) && is_array($product_spectification_value)){
                            foreach ($product_spectification_key as $key => $value) {
                                
                                $product_info = new MallProductInformation();
                                $product_info->mall_product_id = $product_id;
                                $product_info->key = $value;
                                $product_info->value = $product_spectification_value[$key];
                                $product_info->save();
                               
                            }
                        }else{
                            Toastr::error("Mall not associate with this user name", 'Warning',["positionClass" => "toast-top-right"]);
                            return redirect()->back();
                        }
                    }
                        
                }else{
                    array_push($not__insert_data, $product);
                    Toastr::warning("Product Id Already Exists", 'Warning',["positionClass" => "toast-top-right"]);
                    
                }
                Toastr::success($message, 'Success',["positionClass" => "toast-top-right"]);
        }else{
            $product = Product::where('Product_ID',$row['product_id'])->get();
            $brand = Brand::where('brand_name','LIKE','%'.$row['brand_name'].'%')->first();
            $colors = Color::where('name','LIKE','%'.$row['color'].'%')->first();
            $category = Category::where('name','LIKE','%'.$row['product_category_name'].'%')->first();
            $sub_category = Subcategory::where('subcategory_name','LIKE','%'.$row['product_sub_category_name'].'%')->first();
            if(count($product)==0){
                
                $new_product =  new Product;
                $new_product->Product_ID    = $row['product_id'];
                $new_product->productname   = $row['product_name']; 
                $new_product->brand_id   = !empty($brand)?$brand->id:0; 
                $new_product->category_id   = !empty($category)?$category->id:0;
                $new_product->subcategory_id   = !empty($sub_category)?$sub_category->id:0; 
                $new_product->color_id   = !empty($colors)?$colors->id:0; 
                $new_product->product_id_link_to= $row['product_id_link_to'];
                $new_product->cost= $row['cost'];
                $new_product->size= $row['size'];
                $new_product->tax_type= $row['tax_type'];
                $new_product->tax= $row['tax'];
                $new_product->discount= $row['discount'];
                $new_product->product_title= $row['product_title'];
                $new_product->maximum_order= $row['maximum_order'];
                $new_product->rating= $row['rating'];
                $new_product->shipping_type= $row['shipping_type'];
                $new_product->productdescription= $row['blog_description'];
                $new_product->shipping_charge= $row['shipping_charge'];
                $new_product->shipping_time= $row['shipping_time'];
                $new_product->image= $row['main_image'];
                $new_product->save();
                $product_id = DB::getPdo()->lastInsertId();
                $sub_images = explode(',',$row['sub_images']);
                $product_spectification_key = explode(',',$row['product_spectification_key']);
                $product_spectification_value = explode(',',$row['product_spectification_value']);
                if(is_array($sub_images)){
                    foreach ($sub_images as $key => $image) {
                        $product_images = new ProductImage;
                        $product_images->product_id = $product_id;
                        $product_images->product_image = $image;
                        $product_images->save();
                    }
                }
                if(is_array($product_spectification_key) && is_array($product_spectification_value)){
                    foreach ($product_spectification_key as $key => $value) {
                        
                        $product_info = new ProductInformation();
                        $product_info->product_id = $product_id;
                        $product_info->key = $value;
                        $product_info->value = $product_spectification_value[$key];
                        $product_info->save();
                       
                    }
                }
            }else{
                array_push($not__insert_data, $product);
                Toastr::error("Product Id Already Exists", 'Warning',["positionClass" => "toast-top-right"]);
                
            }
            Toastr::success($message, 'Success',["positionClass" => "toast-top-right"]);
        }
    }
    }

            

}

