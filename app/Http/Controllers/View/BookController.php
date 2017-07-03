<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\PdtContent;
use App\Entity\PdtImages;
use Log;

class BookController extends Controller
{
    public function toCategory($value = ''){
        $categorys = Category::whereNull('parent_id')->get();
        return view('category')->with('categorys',$categorys);
    }

 	public function toProduct($category_id){
 		$products = Product::where('category_id', $category_id)->get();
 		return view('product')->with('products', $products);
 	}

 	public function toPdtContent($product_id){
 		$product = Product::find($product_id);
 		$pdt_content = PdtContent::where('product_id', $product_id)->first();
 		$pdt_image = PdtImages::where('product_id', $product_id)->get();
 		$product->content = $pdt_content->content;
 		$product->images = $pdt_image;
 		return view('pdt_content')->with('product', $product);
 	}
   
}