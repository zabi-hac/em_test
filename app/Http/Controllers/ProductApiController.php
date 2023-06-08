<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $products = Product::get();
            return response()->json(['products' => $products], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                if ($file and  $file->isValid()) {

                    $fileName = 'product_' . $pro->id . '.' . $file->getClientOriginalExtension();
                    $path = $file->move(
                        public_path('product_images/'),
                        $fileName
                    );
                    $pro->image = $fileName;
                }

                $pro->save();

                return response()->json(['success' => true, 'product' => $pro], 200);
            } else {
                return response()->json(['status' => 'false'], 202);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $product = Product::find($id);
            return response()->json(['product' => $product], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {

            if ($pro = Product::find($id)) {
                // image upload

                $file =  $request->file('file');

                if ($file and  $file->isValid()) {

                    $fileName = 'product_' . $pro->id . '.' . $file->getClientOriginalExtension();
                    $path = $file->move(
                        public_path('product_images/'),
                        $fileName
                    );
                    $pro->image = $fileName;
                }

                $pro->name = $request->name;
                $pro->price = $request->price;
                $pro->SKU = $request->SKU;
                $pro->status = $request->status;

                $pro->save();

                return response()->json(['success' => true, 'product' => $pro], 200);
            } else {
                return response()->json(['status' => 'false', 'message' => 'product not found'], 202);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($pro = Product::find($id)) {
                $status = $pro->delete();
                return response()->json(['success' => true, 'product' => $pro], 200);
            } else {
                return response()->json(['status' => 'false', 'message' => 'product not found'], 202);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 202);
        }
    }
}
