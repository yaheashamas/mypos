<?php

namespace App\Http\Controllers\Dashboard\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
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

    public function store(Request $request)
    {
        dd($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
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
