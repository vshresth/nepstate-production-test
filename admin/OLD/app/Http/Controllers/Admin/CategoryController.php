<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::where('parent_id', 0)->get();
        return view('category.index', compact('categories'));
    }
    public function showById($id)
    {
        $parentCategory = Categories::findOrFail($id);
        $categories = Categories::where('parent_id', $id)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();
        if ($categories->isEmpty()) {
            return redirect()->back()->with('error', 'No sub-categories found.');
        }
        return view('category.show-sub-cat', compact('categories', 'id', 'parentCategory'));
    }

    public function storeSubCategory(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:categories,title,NULL,id,parent_id,' . $request->parent_id,
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'text_lorum' => 'required|string',
            'parent_id' => 'required|numeric',
        ]);


        $slug = Str::slug($validatedData['title']);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }
        $category = new Categories();
        $category->title = $validatedData['title'];
        // $category->description = $validatedData['description'];
        // $category->image = $imageName;
        $category->text_lorum = $validatedData['text_lorum'];
        $category->parent_id = $validatedData['parent_id'];
        $category->created_at = now();
        $category->slug = $slug;
        $category->save();
        return redirect()->back()->with('success', 'Sub-category added .');
    }

    public function editSubCategory($id)
    {
        $category = Categories::findOrFail($id);
        return view('category.edit-sub-cat', compact('category'));
    }

    public function updateSubCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:categories,title,' . $id,
            // 'tiitle' => 'nullable',
            'description' => 'nullable',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'text_lorum' => 'nullable|string',
        ]);

        $category = Categories::findOrFail($id);
        $category->title = $validatedData['title'];
        // $category->description = $validatedData['description'];
        $category->text_lorum = $validatedData['text_lorum'];

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $category->image = $imageName;
        }
        $category->slug = Str::slug($validatedData['title']);
        $category->save();

        return redirect()->route('category.showById', $category->parent_id)->with('success', 'Sub-category updated .');
    }

    public function destroySubCategory($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('status', 'Sub-category deleted .');
    }
    public function MainEdit($id)
    {
        $category = Categories::findOrFail($id);
        return view('category.maincatEdit', compact('category'));
    }

    public function updateMain(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $category->title = $request->title;
        $category->text_lorum = $request->text_lorum;
        $category->slug = Str::slug($request->title, '-');
        $category->save();

        return redirect()->route('category.index');
    }
}
