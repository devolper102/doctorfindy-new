<?php

namespace App\Http\Controllers\ProductsBrand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsBrandController extends Controller
{
    public function order (){
        return view('back-end/products-brand-page/product-order');
    }
    public function transcations (){
        return view('back-end/products-brand-page/product-transcations');
    }
}
