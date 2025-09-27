@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="col-span-12 mt-6">
        <h2 class="text-lg font-medium mb-4">Edit Category</h2>
        <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $category->title }}">
            </div>
            <br>
            <div class="form-group">
                <label for="text_lorum">Text</label>
                <textarea id="text_lorum" name="text_lorum" class="form-control">{{ $category->text_lorum }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('category.index') }}" class="btn btn-danger">
                Cancel
            </a>
        </form>
    </div>
@endsection
