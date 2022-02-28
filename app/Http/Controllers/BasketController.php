<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BasketController extends Controller
{
    // корзина товаров
    public function basket()
    {
        $order = null;
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
        };
        return view('basket', compact('order'));
    }

    // подтвердить заказ
    public function basketConfirm(Request $request): \Illuminate\Http\RedirectResponse
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);
        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Произошла ошибка!');
        }
        return redirect()->route('index');
    }

    // оформить заказ
    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    // добавление товара в корзину
    public function basketAdd($productId): \Illuminate\Http\RedirectResponse
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
            if ($order->products->contains($productId)) {
                $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
                $pivotRow->count++;
                $pivotRow->update();
            } else {
                $order->products()->attach($productId);
            }

            // заказы авторизованных пользователей
            if(Auth::check()) {
                $order->user_id = Auth::id();
                $order->save();
            }

            $product = Product::find($productId);
            session()->flash('success', 'Добавлен товар ' . $product->name);

            return redirect()->route('basket');
    }

    // удаление товара из корзины
    public function basketRemove($productId): \Illuminate\Http\RedirectResponse
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product = Product::find($productId);
        session()->flash('warning', 'Удален товар ' . $product->name);

        return redirect()->route('basket');
    }
}
