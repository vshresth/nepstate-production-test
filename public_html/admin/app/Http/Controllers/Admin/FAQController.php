<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Faqs;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faqs::all();
        return view('FAQ.index', compact('faqs'));
    }
    public function create()
    {
        $faqs = Faqs::all();
        return view('FAQ.create', compact('faqs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:1,2',
        ]);

        $allowedTags = '<p><a><b><i><strong><em><ul><ol><li><br>';
        $sanitizedDescription = strip_tags($validatedData['description'], $allowedTags);

        $faq = new Faqs();
        $faq->slug = Str::slug($request->title); 
        $faq->title = $validatedData['title'];
        $faq->description = $sanitizedDescription;
        $faq->status = $validatedData['status'];
        $faq->created_at = now();

        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully');
    }
    public function destroy(Faqs $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully');
    }
    public function edit(Faqs $faq)
    {
        return view('FAQ.edit', compact('faq'));
    }

    public function update(Request $request, Faqs $faq)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:1,2',
        ]);
    
        $faq->title = $validatedData['title'];
        $faq->description = $validatedData['description'];
        $faq->status = $validatedData['status'];
        $faq->slug = Str::slug($request->title);

    
        $faq->save();
    
        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully');
    }
}
