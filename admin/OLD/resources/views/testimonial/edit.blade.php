@extends('layouts.app')

@section('title', 'Edit Testimonial')

@section('content')
    <br>
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Edit Testimonial
            </h2>
        </div>
        <br>
        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex" style="justify-content: space-evenly; padding:20px">
                        <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px; margin-left:20px">

                            <label for="name" class="font-medium">Name:</label>
                            <input type="text" id="name" name="name" class="input w-full border mt-2" required
                                value="{{ $testimonial->name }}">
                        </div>
                        <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px;margin-right:20px ">

                            <label for="designation" class="font-medium">Designation:</label>
                            <input type="text" id="designation" name="designation" class="input w-full border mt-2"
                                required value="{{ $testimonial->designation }}">
                        </div>
                    </div>
                    <div class="flex" style="justify-content: space-evenly; padding:20px">
                        <div class="form-group"
                            style="width: -webkit-fill-available; margin-right: 10px; margin-left: 20px;">
                            <label for="stars" class="font-medium">Stars:</label>
                            <select id="stars" name="stars" class="input w-full border mt-2" required
                                style="color: #FFD43B; font-size: 20px;">
                                <option value="5" {{ $testimonial->stars == 5 ? 'selected' : '' }}>
                                    &#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                <option value="4" {{ $testimonial->stars == 4 ? 'selected' : '' }}>
                                    &#9733;&#9733;&#9733;&#9733;</option>
                                <option value="3" {{ $testimonial->stars == 3 ? 'selected' : '' }}>
                                    &#9733;&#9733;&#9733;</option>
                                <option value="2" {{ $testimonial->stars == 2 ? 'selected' : '' }}>&#9733;&#9733;
                                </option>
                                <option value="1" {{ $testimonial->stars == 1 ? 'selected' : '' }}>&#9733;</option>
                            </select>
                        </div>

                        <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px;margin-right:20px ">

                            <label for="image" class="font-medium">Image:</label>
                            @if ($testimonial->image)
                                <div class="mt-2">
                                    <img src="{{ $testimonial->image }}" alt="Current Image" style="max-width: 100px;">
                                </div>
                            @endif
                            <input type="file" id="image" name="image" class="input w-full border mt-2"
                                accept="image/jpeg,image/png,image/jpg*">
                        </div>
                    </div>
                    <div class="p-5">
                        <label for="text" class="font-medium">Text:</label>
                        <textarea id="text" name="text" class="textarea input w-full border mt-2" style="height: 200px" required>{{ $testimonial->text }}</textarea>
                    </div>
                    <script>
                        CKEDITOR.replace('text');
                    </script>
                    <div class="flex justify-end p-5">
                        <button type="submit" class="btn btn-success text-white py-1 px-2" style="margin-right: 10px">Submit</button>
                        <a href="{{ route('testimonials.index') }}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
