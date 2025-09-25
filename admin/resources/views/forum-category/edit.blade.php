@extends('layouts.app')

@section('title')
    Edit Forum Category
@endsection

@section('content')
<br>
<div class="intro-y col-span-12 lg:col-span-6">
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Edit
            </h2>
        </div>
        <div id="input" class="p-5">
            <form action="{{ route('forum.update', $forum->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $forum->title }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
                <div class="mt-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter your address">{{ old('description', $forum->description) }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <script>
                    CKEDITOR.replace('description');
                </script>
                
                <br>
                <button type="submit" class="btn btn-success text-white">
                    Update
                </button>
                <a href="{{ route('forum.index') }}" class="btn btn-danger">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
