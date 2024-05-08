<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\category;
use App\Models\Products;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\updateProductRequest;

class ProductsController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories= category::all();

        $products=Products::when( $request->search,function($q)use($request)
        {
            $q->whereTranslationLike('name','%'.$request->search.'%');
        })->when($request->category_id,function($q)use($request){
            $q->where('category_id',$request->category_id);
        })->latest()->paginate(5);

        return view('dashboard.products.index',compact('products','categories'));

    }//end of index

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= category::all();
        // dd($categories);
        return view('dashboard.products.create',compact('categories'));
    }//end of create

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

       $request_data= $request->all();

    //    dd($request_data);

       if($request->image)
       {
            $file_name=$this->saveImage($request->image,'uploads/product_images');

            $request_data['image']=  $file_name;

            // dd($request_data);
       }


    //    dd($product);

       Products::create($request_data);

    //    dd($product);

         return redirect()->route('dashboard.products.index')->with('success',__('site.added_successfully'));
    }//end of store



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categories=category::all();
        $product=Products::findOrFail($id);

        return view('dashboard.products.edit',compact('product','categories'));
    }//end of edit

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, string $id)
    {
        $request_data= $request->all();

        $product=Products::findOrFail($id);


        if($request->image)
        {
            if($product->image!='default.png')
            {
                Storage::disk('public_uploads')->delete('/product_images/'.$product->image);
            }

             $file_name=$this->saveImage($request->image,'uploads/product_images');

             $request_data['image']=  $file_name;

            //  dd($request_data);
        }

        $product->update($request_data);

        return redirect()->route('dashboard.products.index')->with('success',__('site.updated_successfully'));

    }//end of update

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product=Products::findOrFail($id);

        if($product->image!='default.png')
        {
            Storage::disk('public_uploads')->delete('/product_images/'.$product->image);
        }
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', __('site.deleted_successfully'));

    }//end of destroy
}
