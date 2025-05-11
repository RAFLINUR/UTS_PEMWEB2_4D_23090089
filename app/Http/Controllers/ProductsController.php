<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    
    function index()  {
         return view('dashboard.categories.index');
    }

    function create()  {
        return view('dashboard.products.product_create');
    }

  

    function store(Request $request) {
          /**
         * cek validasi input
         */
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'category' => 'required'
        ]);

        /**
         * jika validasi gagal,
         * maka redirect kembali dengan pesan error
         */
        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors'=>$validator->errors(),
                    'errorMessage'=>'Validasi Error, Silahkan lengkapi data terlebih dahulu'
                ]
            );
        }

        $products = new Products;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->category_id = $request->category;
        
      

        $products->save();

        return redirect()->back()
            ->with(
                [
                    'successMessage'=>'Data Berhasil Disimpan'
                ]
            );
    }
        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**
         * cek validasi input
         */
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'category' => 'required'
        ]);

        /**
         * jika validasi gagal,
         * maka redirect kembali dengan pesan error
         */
        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors'=>$validator->errors(),
                    'errorMessage'=>'Validasi Error, Silahkan lengkapi data terlebih dahulu'
                ]
            );
        }

        $products = Products::find($id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->category_id = $request->category;
        $products->updated_at = date('Y-m-d H:i:s');
    
        $products->save();

        return redirect()->back()
            ->with(
                [
                    'successMessage'=>'Data Berhasil Disimpan'
                ]
            );
    }

        public function edit(string $id)
    {
        $products = Products::find($id);

        return view('dashboard.products.products_edit',[
            'products'=>$products
        ]);
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Products::find($id);

        $products->delete();

        return redirect()->back()
            ->with(
                [
                    'successMessage'=>'Data Berhasil Dihapus'
                ]
            );
    }
}
