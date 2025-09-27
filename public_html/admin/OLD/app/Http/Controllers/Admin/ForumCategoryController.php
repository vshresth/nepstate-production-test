<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forums;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForumCategoryController extends Controller
{
    public function index()
    {
        $forums = Forums::all();
        return view('forum-category.index', compact('forums'));
    }

    public function create()
    {
        return view('forum-category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:forum_categories',
            'description' => 'required|string',
        ]);
        $slug = Str::lower(Str::slug($validatedData['title']));
        $uniqueSlug = $this->makeUniqueSlug($slug);
        $forum = new Forums();
        $forum->title = $validatedData['title'];
        $forum->description = $validatedData['description'];
        $forum->created_at = now();
        $forum->slug = $uniqueSlug;

        $forum->save();

        return redirect()->route('forum.index')->with('success', 'Forum-category created .');
    }


    private function makeUniqueSlug($slug)
    {
        $count = 1;
        $originalSlug = $slug;
        while (Forums::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        return $slug;
    }


    public function edit(Forums $forum)
    {
        return view('forum-category.edit', compact('forum'));
    }

    public function update(Request $request, Forums $forum)
    {
        $request->validate([
            'title' => 'required|unique:forum_categories,title,' . $forum->id,
            'description' => 'required|string',
        ], [
            'title.required' => 'The title field is required.',
            'title.unique' => 'The title must be unique.',
            'description.required' => 'The description field is required.',
        ]);

        $slug = Str::lower(Str::slug($request->title));
        if ($slug !== $forum->slug) {
            $slug = $this->makeUniqueSlug($slug);
        }

        $forum->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $slug,
        ]);

        return redirect()->route('forum.index')->with('success', 'Forum-Category updated ');
    }

    public function destroy(Forums $forum)
    {
        $forum->delete();
        return redirect()->route('forum.index')
            ->with('message', 'Forum deleted');
    }
    
}
