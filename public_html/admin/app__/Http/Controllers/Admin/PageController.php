<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Pages::all();
        return view('staticpage.index', compact('pages'));
    }

    public function edit($slug)
    {
        $page = Pages::where('slug', $slug)->firstOrFail();
        return view('staticpage.staticpage', compact('page'));
    }
    
     public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'descriptions' => 'required|string',
            'status' => 'required|in:1,2',
            'bullets' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $page = Pages::where('slug', $slug)->firstOrFail();
    
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), 'image', $page);
        }
    
        if ($request->hasFile('image_2')) {
            $this->uploadImage($request->file('image_2'), 'image_2', $page);
        }
    
        if ($request->hasFile('image_3')) {
            $this->uploadImage($request->file('image_3'), 'image_3', $page);
        }
    
        
        if (!empty($validatedData['bullets'])) {
            $validatedData['bullets'] = nl2br(e($validatedData['bullets']));
        }
    
        $page->update($validatedData);
    
        return redirect()->route('static.index')->with('success', 'Page updated successfully');
    }

    public function updatess(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'descriptions' => 'required|string',
            'status' => 'required|in:1,2',
            'bullets' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $page = Pages::where('slug', $slug)->firstOrFail();

        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), 'image', $page);
        }

        if ($request->hasFile('image_2')) {
            $this->uploadImage($request->file('image_2'), 'image_2', $page);
        }

        if ($request->hasFile('image_3')) {
            $this->uploadImage($request->file('image_3'), 'image_3', $page);
        }

        $page->update($validatedData);

        return redirect()->route('static.index')->with('success', 'Page updated successfully');
    }

    private function uploadImage($file, $fieldName, $page)
    {
        if ($page->$fieldName && file_exists(public_path(parse_url($page->$fieldName, PHP_URL_PATH)))) {
            unlink(public_path(parse_url($page->$fieldName, PHP_URL_PATH)));
        }

        $imageName = time() . '_' . $fieldName . '.' . $file->extension();
        $file->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $page->$fieldName = $imageUrl;
    }
}

