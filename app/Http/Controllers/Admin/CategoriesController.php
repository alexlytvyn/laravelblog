<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $objCategory = new Category();
				$categories = $objCategory->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function addCategory()
    {
        return view('admin.categories.add');
    }

    public function addRequestCategory(Request $request)
    {
        try {
            $this->validate($request, [
                    'title' => 'required|string|min:3|max:50'
                ]);
            $objCategory = new Category();
            $objCategory = $objCategory->create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description')
                ]);
            if ($objCategory) {
                return back()->with('success', 'The Category was added successfully!');
            } else {
                return back()->with('error', 'The Category was not added!');
            }
            dd($request->all());
        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function editCategory(int $id)
    {
    }

    public function deleteCategory(Request $request)
    {
        if ($request->ajax()) {
        }
    }
}
