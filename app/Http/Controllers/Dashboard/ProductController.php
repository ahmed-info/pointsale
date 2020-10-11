<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_products'])->only(['index']);
        $this->middleware(['permission:create_products'])->only(['create', 'store']);
        $this->middleware(['permission:update_products'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_products'])->only(['destroy']);

    }//end of constructor

    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(3);

        $categories = Category::all();
        return view('dashboard.products.index', compact('products', 'categories'));

    }//end of index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));

    }//end of create

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|min:1',
            'sale_price' => 'required|min:1',
            'stock' => 'required|min:1',
        ];

        $request->validate($rules);

        $request_data = $request->except(['image']);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }//end of if

        Product::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of store

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));

    }//end of edit

    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|min:1',
            'sale_price' => 'required|min:1',
            'stock'=>'required',
        ];


        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            }//end of if

            Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
     

        }//end of if
        $product->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    }
  //end of update

    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of destroy

}//end of controller
