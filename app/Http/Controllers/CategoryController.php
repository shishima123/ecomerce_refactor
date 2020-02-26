<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\ImageProduct;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->withCount('subcategories')
            ->get();

        return view('Admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category;
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->save();
            return redirect()
                ->route('category.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Add Category success.']);
        } catch (Exception $e) {
            return redirect()
                ->route('category.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail to Add Category. Please try again.']);
        }

    }

    public function show($id)
    {
        $category = Category::where('id', '=', $id)->firstOrFail();
        $categories = Category::where('parent_id', 0)
            ->get();

        return view('Admin.category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::where('id', '=', $id)->firstOrFail();
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            if (Input::hasFile('categoryImage')) {
                $file = $request->file('categoryImage');
                $file_extension = $file->getClientOriginalExtension();
                $file_name = uniqid('img_') . '.' . $file_extension;
                $category->picture = '/upload/imgCategory/' . $file_name;
                $file->move('upload/imgCategory/', $file_name);
            }
            $category->save();
            return redirect()
                ->route('category.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Update Category.']);
        } catch (Exception $e) {
            return redirect()
                ->route('category.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Update Category.']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $products = Product::where('category_id', $id)->get();
            foreach ($products as $product) {
                $product->orders()->detach();
                $product->users()->detach();
                $images = ImageProduct::where('product_id', $id)
                    ->get();

                if (!empty($images)) {
                    foreach ($images as $img) {
                        unlink(public_path($img->path));
                    }
                }
                $product->image_products()->delete();
                $product->delete();
            }
            $category = Category::where('id', '=', $id)->firstOrFail();
            if ($category->picture) {
                unlink(public_path($category->picture));
            }
            $category->delete();
            DB::commit();

            return redirect()
                ->route('category.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Delete Category.']);
        } catch (Exception $e) {
            DB::rollback();

            return redirect()
                ->route('category.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Delete Category.']);
        }
    }
}
