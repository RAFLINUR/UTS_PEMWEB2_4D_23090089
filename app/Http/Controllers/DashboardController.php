<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function products(Request $request){
        $products = Products::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
                      
            })
            ->paginate(10);

        return view('dashboard.products.index', [
            'products' => $products,
            'q' => $request->q
        ]);
        
    }

    function create_product()  {
     return view('dashboard.products.product_create');   
    }
}
