<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::get();
        return view('auth.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('auth.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $params = $request->all();
        unset($params['images']);
        // проверка для картинки, что она не обязательна
        if ($request->has('images')) {
            $path = $request->file('images')->store('categories');
            $params['images'] = $path;
        }
        Category::create($params);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param category $category
     * @return Application|Factory|View
     */
    public function show(category $category)
    {
        return view('auth.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param category $category
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('auth.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, category $category)
    {
        $params = $request->all();
        unset($params['images']);
        if ($request->has('images')) {
            Storage::delete($category->images);
            $path = $request->file('images')->store('categories');
            $params['images'] = $path;
        }
        $category->update($params);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param category $category
     * @return RedirectResponse
     */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
