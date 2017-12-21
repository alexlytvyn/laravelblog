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
                    'title' => 'required|string|min:3|max:50',
										'description' => 'required'
                ]);
            $objCategory = new Category();
            $objCategory = $objCategory->create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description')
                ]);
            if ($objCategory) {
                return redirect(route('categories'))->with('success', 'The Category was added successfully!');
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
        $category = Category::find($id);
        if (!$category) {
            return abort(404);
        } else {
            return view('admin.categories.edit', ['category' => $category]);
        }
    }

    public function editRequestCategory(Request $request, int $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string|min:3|max:50',
								'description' => 'required'
                ]);
            $objCategory = Category::find($id);
            if ($objCategory) {
                $objCategory->title = $request->input('title');
                $objCategory->description = $request->input('description');
            } else {
                return abort(404);
            }

            if ($objCategory->save()) {
                return redirect(route('categories'))->with('success', 'The Category was edited successfully!');
            } else {
                return back()->with('error', 'The Category was not edited!');
            }
            dd($request->all());
        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

		public function deleteCategory(Request $request)
	{
			if($request->ajax()) {
					 $id = (int)$request->input('id');
					 $objCategory = new Category();
					 $objCategory->where('id', $id)->delete();
					 echo "Successful deleting!";
			}
	}
}
