@extends('layouts.app')

@section('title')
    Create Blog Post
@endsection

@section('content')
    <br>
    <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Create Blog Post
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}" placeholder="Enter the title" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" name="author" id="author" class="form-control"
                                    value="{{ old('author') }}" placeholder="Enter the author's name" required>
                                @error('author')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <br>
                            <div class="form-group">
                                <label for="uID" class="col-form-label">User</label>
                                <select id="uID" class="form-control" name="uID" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('uID')
                                    <span class="errorMessage">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            
                            <br>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control height_100" >{{old('description')}}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                        
                        
                        </div>
                        <br>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" name="tags" id="tags" class="form-control"
                                    value="{{ old('tags') }}" placeholder="Enter tags separated by commas">
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file"
                                    accept="image/jpeg,image/png,image/jpg">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                           
                        </div>
                    </div>
                    <br>
                    
                    <br>
                    <button type="submit" class="btn btn-success text-white">
                        Create Blog Post
                    </button>
                    <a href="{{ route('blogs.index') }}" class="btn btn-danger">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
