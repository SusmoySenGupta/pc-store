<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest as Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $tags       = Tag::pluck('name', 'id');
        $brands     = Brand::all();
        $categories = Category::all();

        return view('admin.product.create', compact('tags', 'brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request)
            {
                $product = Product::create($request->all());

                $product->tags()->attach($request->tags);

                foreach ($request->product_images as $image)
                {
                    $file_name  = uniqid() . '.' . $image->extension();
                    $image_path = $image->storeAs('public/images/products', $file_name);

                    $product->images()->create(['path' => $image_path]);
                }

                Alert::toast("A new product '{$product->name}' has been created", 'success')
                    ->padding('0.3rem')
                    ->width('20rem')
                    ->position('bottom-right')
                    ->background('#F9FAFB')
                    ->timerProgressBar();
            });

            return redirect()->route('admin.products.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): View
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): View
    {
        $brands     = Brand::all();
        $categories = Category::all();
        $tags       = Tag::pluck('name', 'id');
        $tag_ids    = $product->tags->pluck('id')->toArray();

        return view('admin.product.edit', compact('product', 'brands', 'categories', 'tags', 'tag_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        try {
            $product->load('images');

            DB::transaction(function () use ($request, $product)
            {
                $product->update($request->all());
                $product->tags()->sync($request->tags);

                if ($request->product_images)
                {
                    foreach ($product->images as $image)
                    {
                        if (Storage::exists($image->path))
                        {
                            Storage::delete($image->path);
                        }
                    }
                    $product->images()->delete();

                    foreach ($request->product_images as $image)
                    {
                        $file_name  = uniqid() . '.' . $image->extension();
                        $image_path = $image->storeAs('public/images/products', $file_name);

                        $product->images()->create(['path' => $image_path]);
                    }
                }

                Alert::toast("'{$product->name}' has been updated", 'success')
                    ->padding('0.3rem')
                    ->width('20rem')
                    ->position('bottom-left')
                    ->background('#F9FAFB')
                    ->timerProgressBar();
            });

            return redirect()->route('admin.products.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        try {
            $product->delete();

            Alert::toast("'{$product->name}' has been deleted", 'error')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-right')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.products.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }
}
