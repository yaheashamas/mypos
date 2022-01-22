<?php

namespace App\Http\Controllers\Dashboard\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\models\Order;
use App\Models\Product;
use App\Repositories\CategoryRepository;

class OrderController extends Controller
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        //
    }

    public function create(Client $client)
    {
        $categories = $this->categoryRepository->with('products')->get();
        return view('dashboard.clients.orders.create',compact(['categories','client']));
    }

    public function store(OrderRequest $request ,Client $client)
    {
       $order = $client->orders()->create([]);
       $total_price = 0;
        foreach ($request->products as $index=>$product) {
            //fiend object
            $find_product = Product::findOrFail($product);
            //sum all prices
            $total_price += $find_product->sale_price * $request->quantities[$index];
            $order->products()->attach($product,['quantity' => $request->quantities[$index]]);
            $find_product->update([
                'stock' => $find_product->stock - $request->quantities[$index]
            ]);
        }//end of foreach
        $order->update(['total_price' => $total_price]);
        session()->flash('success',__('site.message_add'));
        return redirect()->route('dashboard.orders.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Client $client,Order $order)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
