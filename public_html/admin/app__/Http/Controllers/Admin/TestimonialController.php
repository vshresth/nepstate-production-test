<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonial.index', compact('testimonials'));
    }
    public function show()
    {
        $testimonials = Testimonial::all();
        return view('testimonial.create', compact('testimonials'));
    }
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        $imageName = time() . '.' . $request->file('image')->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);

        Testimonial::create(['name' => $request->name, 'designation' => $request->designation, 'stars' => $request->stars, 'image' => $imageUrl, 'text' => $request->text]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
    public function edit(Testimonial $testimonial)
    {
        $testimonials = Testimonial::all();
        return view('testimonial.edit', compact('testimonial'));
    }
    public function update(Request $request, Testimonial $testimonial)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'stars' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'text' => 'required|string',
        ]);

        if ($request->hasFile('image')) {

            if ($testimonial->image && file_exists(public_path(parse_url($testimonial->image, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($testimonial->image, PHP_URL_PATH)));
            }


            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imageUrl = url('images/' . $imageName);
            $validatedData['image'] = $imageUrl;
        }

        $testimonial->update($validatedData);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }
}
