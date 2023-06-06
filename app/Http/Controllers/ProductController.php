<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProducts()
    {

        $products = Product::get();
        return view('product.view', compact('products'));
    } // fun  





    public function editProductview(Request $request)
    {
        $product =  Product::findOrFail($request->id);
        return view('product.edit', compact('product'));
    } // fun  




    public function editProduct(Request $request)
    {

        // dd($request->all());

        try {

            $pro = Product::findOrFail($request->id);

            if ($pro->update($request->all())) {

                $file =  $request->file('file');

                $fileName = 'product_' . $pro->id . '.' . $file->getClientOriginalExtension();
                $path = $file->move(
                    public_path('product_images/'),
                    $fileName
                );


                $pro->image = $fileName;

                $pro->save();

                return redirect()->route('viewProducts')->with('success', 'Updated');
            } else {
                return back()->withErrors('error', 'error on update');
            }
        } catch (\Throwable $th) {
            return back()->withErrors('error', $th->getMessage());
        }
    } // fun 


    public function createProductview()
    {
        return view('product.create');
    } // fun  

    public function createProduct(Request $request)
    {

        // dd($request->all());

        try {
            $validated =    $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:products'],
                'price' => ['required'],
                // 'file' => ['required'],
                'SKU' => 'nullable',
                'status' => 'nullable',
            ]);


            if ($pro = Product::create($validated)) {
                // image upload

                $file =  $request->file('file');

                $fileName = 'product_' . $pro->id . '.' . $file->getClientOriginalExtension();
                $path = $file->move(
                    public_path('product_images/'),
                    $fileName
                );


                $pro->image = $fileName;

                $pro->save();

                return back()->with('success', 'Success');
            } else {
                return back()->withErrors('error', 'error');
            }
        } catch (\Throwable $th) {
            return back()->withErrors('error', $th->getMessage());
        }
    } // fun 


    public function deleteProduct(Request $request)
    {
        try {

            $pro = Product::findOrFail($request->id);

            if ($pro->delete()) {
                return back()->with('success', 'Deleted Product');
            } else {
                return back()->withErrors('error', 'error on update');
            }
        } catch (\Throwable $th) {
            return back()->withErrors('error', $th->getMessage());
        }
    } // fun 
}
