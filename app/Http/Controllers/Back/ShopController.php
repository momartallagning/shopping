<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{
    public function edit()
    {
        $shop = Shop::firstOrFail();

        return view('back.shop.edit', compact('shop'));
    }

    public function update(ShopRequest $request)
	{
	    $request->merge([
	        'invoice' => $request->has('invoice'),
	        'card' => $request->has('card'),
	        'transfer' => $request->has('transfer'),
	        'check' => $request->has('check'),
	        'mandat' => $request->has('mandat'),
	    ]);        
	    Shop::firstOrFail()->update($request->all());
	    return back()->with('alert', config('messages.shopupdated'));
	}
}