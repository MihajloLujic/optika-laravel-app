<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();

        return view('order.index', [
            'orders' => $orders,
        ]);
    }

    public function create(Request $request)
    {
        return view('order.create');
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create($request->validated());

        $request->session()->flash('order.id', $order->id);

        return redirect()->route('orders.index');
    }

    public function show(Request $request, Order $order)
    {
        return view('order.show', [
            'order' => $order,
        ]);
    }

    public function edit(Request $request, Order $order)
    {
        return view('order.edit', [
            'order' => $order,
        ]);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        $request->session()->flash('order.id', $order->id);

        return redirect()->route('orders.index');
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }


    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Korpa je prazna.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Korpa je prazna.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        \App\Models\Order::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'total' => $total,
            'status' => 'pending',
        ]);

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Porudžbina je uspešno poslata!');
        }
    public function markAsPaid(Order $order)
        {
            $order->update(['status' => 'paid']);
            return redirect()->back()->with('success', 'Porudžbina označena kao plaćena.');
        }

    public function markAsCancelled(Order $order)
        {
            $order->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Porudžbina otkazana.');
        }
        
    public function markAsPending(Order $order)
        {
            $order->update(['status' => 'pending']);
            return redirect()->back()->with('success', 'Status postavljen na PENDING.');
        }

}