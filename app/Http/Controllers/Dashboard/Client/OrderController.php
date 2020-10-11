<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        
    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client','categories'));
    }

    public function store(Request $request, Client $client)
    {
        dd($request->all());
    }

    public function show()
    {
        //
    }

    public function edit(Client $client, Order $order)
    {
        //
    }

    public function update(Request $request, Client $client ,Order $order)
    {
        //
    }

    public function destroy(Client $client ,Order $order)
    {
        //
    }
}
