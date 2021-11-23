<?php

namespace App\Http\Controllers\Dashboard;

use App\models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Traits\imagable;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    use imagable;

    public function __construct(ProductRepository $productRepository,CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->all();
        $products = $this->productRepository->SearchProduct($request->search,$request->category_id);
        return view('dashboard.product.index',compact('categories','products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('dashboard.product.create',compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $nameImage = '';
        if ($request->hasFile('image')){
           $nameImage = $this->createImage($request->image,'imageProduct/');
        }
        $this->productRepository->create($request->hasFile('image') ? array_merge($request->toArray(),['image' =>$nameImage]) : array_except($request->toArray(),'image'));
        session()->flash('success',__('site.message_add'));
        return redirect()->route('dashboard.products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryRepository->all();
        $product = $this->productRepository->getById($product->id);
        return view('dashboard.product.edit',compact(['product','categories']));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $nameImage = '';
        if ($request->hasFile('image')){
            if ($product->image == "default.png") {
                $nameImage = $this->createImage($request->image,'imageProduct/');
            }else{
                $this->deleteImage('imageProduct/',$product->image);
                $nameImage = $this->createImage($request->image,'imageProduct/');
            }
        }
        $this->productRepository->updateById($product->id,$request->hasFile('image') ? array_merge($request->toArray(),['image' =>$nameImage]) : array_except($request->toArray(),'image'));
        session()->flash('success',__('site.message_add'));
        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage('imageProduct/',$product->image);
        $this->productRepository->deleteById($product->id);
        session()->flash('success',__('site.message_delete'));
        return redirect()->route('dashboard.products.index');
    }
}
