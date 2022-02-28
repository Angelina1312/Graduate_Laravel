<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // функция для главной страницы
    public function index(ProductsFilterRequest $request) {
        // для просмотра всех методов
        //dd(get_class_methods($request));
        $productsIndexQuery = Product::query();
        // цена от и до фильтр
        if ($request->filled('price_from')) {
            $productsIndexQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsIndexQuery->where('price', '<=', $request->price_to);
        }
        // хит продаж, рекомендуем и новинки фильтр
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has('$field')) {
                $productsIndexQuery->where($field, 1);
            }
        }

        $products = $productsIndexQuery->paginate(3)->withPath("?" . $request->getQueryString());
        return view('index', compact('products'));
    }

    // функция для страницы со всеми товарами
    public function all_tovs(ProductsFilterRequest $request) {
        // для просмотра всех методов
        //dd(get_class_methods($request));
        $productsQuery = Product::query();
        // цена от и до фильтр
        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }
        // хит продаж, рекомендуем и новинки фильтр
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has('$field')) {
                $productsQuery->where($field, 1);
            }
        }

        $products = $productsQuery->paginate(12)->withPath("?" . $request->getQueryString());
        return view('all_tovs', compact('products'));
    }
    /*public function index(ProductsFilterRequest $request) {
        // для просмотра всех методов
        //dd(get_class_methods($request));
        $productsQuery = Product::query();
    // цена от и до фильтр
        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }
        // хит продаж, рекомендуем и новинки фильтр
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has('$field')) {
                $productsQuery->where($field, 1);
            }
        }

        $products = $productsQuery->paginate(12)->withPath("?" . $request->getQueryString());
        return view('index', compact('products'));
    }*/

    // функция для страницы категорий
    public function categories() {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    // добавляем динамику категориям
    public function category($code) {
        // добавляем из бд
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    // функция для страницы товара
    //public function product($category, $product = null) {
      //  return view('product', ['product' => $product]);
    //}

    public function product($category, $productCode) {
       $product = Product::byCode($productCode)->first();
        return view('product', compact('product'));
    }

    // страница о нас
    public function about() {
        return view('about');
    }

    // страница наши преимущества
    public function advantages() {
        return view('advantages');
    }

    // страница полезная информация
    public function information() {
        return view('information');
    }

    // страница как формить заказ
    public function placeOrder() {
        return view('placeOrder');
    }

    // страница способы оплаты
    public function payment() {
        return view('payment');
    }

    // страница обмен и возврат
    public function exchange() {
        return view('exchange');
    }

    // страница обмен и возврат
    public function contacts() {
        return view('contacts');
    }

}
