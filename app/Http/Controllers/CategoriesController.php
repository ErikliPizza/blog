<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('manage-categories', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $attributes = $this->validateCategory();

        Category::create($attributes);

        return back();
    }

    public function update()
    {
        $attributes = $this->validateCategory();

        Category::find(request()->id)?->update($attributes);

        return back();
    }

    public function destroy()
    {
        Category::find(request()->id)?->delete();
        return back();
    }

    protected function validateCategory()
    {
        if(request()->id != null )
        {
            $category = Category::find(request()->id);
        } else {
            $category = new Category();
        }
        return request()->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category)],
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($category)],
        ]);
    }
}
