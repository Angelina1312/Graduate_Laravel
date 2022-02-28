<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;


Auth::routes();

// вернуть проект в начальное состояние
//Route::get('reset', ResetController::class, 'reset')->name('reset');


// вызываем logout по get
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('get-logout');

// проверка авторизации везде
Route::middleware(['auth'])->group(function () {
    Route::group([
        'prefix' => 'person',
        'namespace' => 'Person',
        'as' => 'person.',
    ], function () {
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    });

// проверка регистрации через группу маршрутов
    Route::group([
        'prefix' => 'admin',
    ], function () {
        // проверка админ или нет
        Route::group(['middleware' => 'is_admin'], function () {
            Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('home');
            Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        });
        // регистрируем все маршруты категорий сразу
        Route::resource('categories', CategoryController::class);
        // регистрируем все маршруты товаров сразу
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    });
});

// главная страница
Route::get('/', [MainController::class, 'index'])->name('index');

// страница со всеми товарами
Route::get('/all_tovs', [MainController::class, 'all_tovs'])->name('all_tovs');

// страница о нас
Route::get('/about', [MainController::class, 'about'])->name('about');

// страница наши преимущества
Route::get('/advantages', [MainController::class, 'advantages'])->name('advantages');

// страница полезная информация
Route::get('/information', [MainController::class, 'information'])->name('information');

// страница как оформить заказ
Route::get('/place_order', [MainController::class, 'placeOrder'])->name('place-order');

// страница способы оплаты
Route::get('/payment', [MainController::class, 'payment'])->name('payment');

// страница обмен и возврат
Route::get('/exchange', [MainController::class, 'exchange'])->name('exchange');

// страница контакты
Route::get('/contacts', [MainController::class, 'contacts'])->name('contacts');

// страница категории
//use App\Http\Controllers\MainController;
Route::get('/categories', [MainController::class, 'categories'])->name('categories');

// добавление товара
Route::group(['prefix' => 'basket'], function () {
    Route::post('/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');

    // корзина товаров
    Route::group(['middleware' => 'basket_not_empty',
    ], function () {
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
// оформить заказ
        Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');
// удаление товара
        Route::post('/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');
// подвердить заказ
        Route::post('/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
    });
});

// добавляем динамику категориям
Route::get('/{category}', [MainController::class, 'category'])->name('category');

// страница товара
Route::get('/{category}/{product?}', [MainController::class, 'product'])->name('product');









