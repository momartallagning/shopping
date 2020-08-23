<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image as InterventionImage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $inputs = $this->getInputs($request);
        Product::create($inputs);
        return back()->with('alert', config('messages.productcreated'));
    }
    protected function saveImages($request)
    {
        $image = $request->file('image');
        $name = time() . '.' . $image->extension();
        $img = InterventionImage::make($image->path());
        $img->widen(800)->encode()->save(public_path('/images/') . $name);
        $img->widen(400)->encode()->save(public_path('/images/thumbs/') . $name);
        return $name;
    }
    protected function getInputs($request)
    {
        $inputs = $request->except(['image']);
        $inputs['active'] = $request->has('active');
        if($request->image) {
            $inputs['image'] = $this->saveImages($request);
        }
        return $inputs;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $produit)
    {
        return view('back.products.form', ['product' => $produit]);
    }

    protected function deleteImages($produit)
    {
        File::delete([
            public_path('/images/') . $produit->image, 
            public_path('/images/thumbs/') . $produit->image,
        ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $produit)
    {
        $inputs = $this->getInputs($request);

        if($request->has('image')) {
            $this->deleteImages($produit);        
        }

        $produit->update($inputs);

        return back()->with('alert', config('messages.productupdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $produit)
    {
        $this->deleteImages($produit); 

        $produit->delete();

        return redirect(route('produits.index'));
    }
}
