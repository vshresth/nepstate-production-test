@extends('layouts.app')

@section('title')
    Static Page
@endsection

@section('content')
    <br>
    <div class="container space-around">
        <div class="intro-y block sm:flex items-center h-10 w-full">
            <h2 class="text-lg font-medium truncate mr-5">
                Static Page
            </h2>
        </div>
    </div>
    <form action="{{ route('staticpage.update', $page->slug) }}" method="POST" class="grid grid-cols-4 w-full sm:w-auto"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div class="intro-y  col-span-4 w-full sm:w-auto">
            <div class="intro-y col-span-4 box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Update
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" value="{{ $page->title }}" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="slug">Slug:</label>
                        <input type="text" class="form-control" name="slug" value="{{ $page->slug }}" readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="descriptions">Description:</label>
                        <textarea class="form-control" name="descriptions" style="height:100px">{{ $page->descriptions }}</textarea>
                    </div>
                    <script>
                        CKEDITOR.replace('descriptions');
                    </script>
                    <br>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ $page->status == 2 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <br>

                    @if ($page->slug == 'about-us')
                        <div class="form-group">
                            <label for="bullets">Bullets:</label>
                            <textarea class="form-control" name="bullets" style="height:100px">{{ str_replace(['<br>', '<br/>', '<br />'], "", $page->bullets) }}</textarea>
                        </div>

                        <div class="mt-3" style="display: flex;justify-content:space-evenly">
                            <div class="me-3">
                                <label for="image" class="form-label">Image 1</label>
                                <input type="file" name="image" id="image" class="form-control-file"
                                    accept="image/jpeg,image/png,image/jpg">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($page->image)
                                    <img src="{{ $page->image }}" alt="Image 1"
                                        style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </div>

                            <div class="me-3">
                                <label for="image_2" class="form-label">Image 2</label>
                                <input type="file" name="image_2" id="image_2" class="form-control-file"
                                    accept="image/jpeg,image/png,image/jpg">
                                @error('image_2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($page->image_2)
                                    <img src="{{ $page->image_2 }}" alt="Image 2"
                                        style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </div>

                            <div>
                                <label for="image_3" class="form-label">Image 3</label>
                                <input type="file" name="image_3" id="image_3" class="form-control-file"
                                    accept="image/jpeg,image/png,image/jpg">
                                @error('image_3')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($page->image_3)
                                    <img src="{{ $page->image_3 }}" alt="Image 3"
                                        style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </div>
                        </div>
                    @endif


                    <div class="w-full sm:w-auto pt-4">
                        <button type="submit" class="btn btn-success text-white">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
