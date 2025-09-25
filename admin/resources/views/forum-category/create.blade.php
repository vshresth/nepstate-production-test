@extends('layouts.app')

@section('title')
    Create Forum Categories
@endsection

@section('content')
    <br>
    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Create
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" placeholder="Enter category title" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" value="{{ old('description') }}"
                                    placeholder="Enter category description"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <script>
                                CKEDITOR.replace('description');
                            </script>
                            <br>

                        </div>
                        <br>


                        <br>
                        <button type="submit" class="btn btn-success text-white">
                            Create
                        </button>
                        <a href="{{ route('forum.index') }}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
    </form>
@endsection
