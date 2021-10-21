<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest as Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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

                if ($request->product_image)
                {
                    foreach ($request->product_images as $image)
                    {
                        $file_name  = uniqid() . '.' . $image->extension();
                        $image_path = $image->storeAs('public/images/products', $file_name);

                        $product->images()->create(['path' => $image_path]);
                    }
                }

                toast('Product created successfully', 'success');
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

                toast('Product edited successfully', 'success');
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

            toast('Product deleted successfully', 'error');

            return redirect()->route('admin.products.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\View\View
     */
    public function trashed(): view
    {
        $this->authorize('viewany', Product::class);

        $products = Product::onlyTrashed()
            ->orderBy('deleted_at', 'DESC')
            ->paginate(10);

        return view('admin.product.trashed', compact('products'));
    }

    /**
     * Restore the specified product.
     *
     * @param  \Illuminate\Http\Request  $http_request
     * @param int $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(HttpRequest $http_request, $product_id): RedirectResponse
    {
        $product = Product::withTrashed()->findOrFail($product_id);

        $this->authorize('restore', $product);

        try {
            $product->restore();

            toast('Product restored successfully', 'success');

            return redirect()->route('admin.products.trashed');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }

    /**
     * Permanently deletes the specified product.
     *
     * @param int $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($product_id): RedirectResponse
    {
        $product = Product::withTrashed()->findOrFail($product_id);

        $this->authorize('forceDelete', $product);

        try {
            $product->forceDelete();

            toast('Product deleted permanently', 'error');

            return redirect()->route('admin.products.trashed');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }
}
