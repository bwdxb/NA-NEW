<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Product;
use App\MallProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements  FromView {
	
	use Exportable;

    protected $mall_id;

    function __construct($mall_id='') {
            $this->mall_id = !empty($mall_id)?$mall_id:'';
    }

    public function view(): View
    {
        if(!empty($this->mall_id)){
            return view('Admin.mall.product_management.export', [
                'products' => MallProduct::with('getBrand','categoryDetails','subCategoryDetails')->where('mall_id',$this->mall_id)->get()
            ]);
        }else{
            return view('product_management.export', [
                'products' => Product::with('getBrand','categoryDetails','subCategoryDetails')->get()
            ]);
        }
        
    }

    // public function map($product): array
    // {
    //     // $question 

    //     return [
    //         $this->i++,
    //         (!empty($product->Product_ID))?$product->Product_ID:'',
    //         (!empty($product->productname))?$product->productname:'',
    //         (!empty($product->categoryDetails->name))?$product->categoryDetails->name:'',
    //         (!empty($product->subCategoryDetails->subcategory_name))?$product->subCategoryDetails->subcategory_name:'',
    //         (!empty($product->getBrand->brand_name))?$product->getBrand:'',
    //         (!empty($product->created_at))?$product->created_at:'',
            
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         'Product_ID',
    //         'Product Name',
    //         'Product category',
    //         'Product Sub Category',
    //         'Product Brand',
    //         'Created At',
    //     ];
    // }
    

    
}
