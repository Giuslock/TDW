<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Wishlist;
use App\Product;

class WishlistProductController extends Controller
{
    
    public function index(Wishlist $wishlist)
    {
        return view('wishlist')->with(['products' => $wishlist->products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Wishlist $wishlist, Request $request)
    {
        
        $product = $request->input('product');
        $products = $wishlist->products;
        if(! $products->contains($product)) {
            $wishlist->products()->attach($product);
            $wishlist->push();
        }
        return redirect()->route('wishlists.products.index', ['wishlist' => $wishlist->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        
    }

    
    public function destroy(Wishlist $wishlist, Product $product)
    {
        $wishlist->products()->detach($product);
        return redirect()->back();
    }
}
