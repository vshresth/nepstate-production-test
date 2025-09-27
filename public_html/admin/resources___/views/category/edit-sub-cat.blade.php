@extends('layouts.app')

@section('title')
    Edit Sub Category
@endsection

@section('content')
<br>
<form action="{{ route('category.updateSubCategory', $category->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Edit Sub Category
                    </h2>
                    {{-- <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                        <a href="{{ route('category.index') }}" class="btn btn-danger">Return
                        </a>
                    </div> --}}
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"> Title:</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $category->title }}">
                            </div>
                            {{-- <br> --}}
                            {{-- <div class="form-group">
                                <label for="image"> Image:</label>
                                <input type="file" name="image" id="image" class="form-control-file"
                                    accept="image/jpeg,image/png,image/jpg">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($category->image)
                                    <img src="{{ asset('uploads/' . $category->image) }}" alt="Image"
                                        style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </div> --}}
                            <br>
                        </div>
                        <div class="col-md-6">
                            {{-- <div class="form-group">
                                <label for="description"> Description:</label>
                                <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
                            </div> --}}
                            <br>
                            <div class="form-group">
                                <label for="text_lorum"> Text Lorem:</label>
                                <textarea class="form-control" id="text_lorum" name="text_lorum">{{ $category->text_lorum }}</textarea>
                            </div>
                               
                            <script>
                                CKEDITOR.replace('text_lorum');
                            </script>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success text-white mt-5">Update</button>
                    <a href="#" onclick="history.back();" class="btn btn-danger custom-button">
                         Cancel
                    </a>
                   
                  
                </div>
            </div>
        </div>
    </form>
    
@endsection
