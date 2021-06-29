<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
      $allproduct= Product::paginate(5);
      $allproduct1= Product::all();
      $varients=[];
      foreach ($allproduct as $product)
      {
        $varients= ProductVariantPrice::where('product_id',$product->id)->get();
      }
      $counter=1;
      $productVariant=[];
      foreach ($varients as $varient)
        {

           $productVariant=ProductVariant::where(function ($query) use ($varient) {
            $query->where('id',$varient->product_variant_one)
           ->orWhere('id',$varient->product_variant_two)
           ->orWhere('id',$varient->product_variant_three);
           })->get();
        }
        $productimg1=$provariant=[];

        foreach ($productVariant as $productimg)
        {  
          $productimg1=ProductImage::where('product_id',$productimg->product_id)->get();
          $provariant=Variant::find($productimg->variant_id);
         
         }
          $provariant=Variant::find($productimg->variant_id);
        
          return view('products.index', compact('allproduct','varients','productVariant','productimg1','provariant','counter','allproduct1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();

        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
     
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function search(Request $request)
    {   $counter=0;
       
        $search=$request->input('title');
       if($search!=""){
         $allproduct = Product::where('title', 'like', '%'.$search.'%')->paginate(2);
         $allproduct1 = Product::where('title', 'like', '%'.$search.'%');
         $allproduct->appends(['title' => $search]);
   }
   else{
    $allproduct = Product::paginate(10);
   }
return view('products.index', compact('allproduct','allproduct1','counter'));
}

}
