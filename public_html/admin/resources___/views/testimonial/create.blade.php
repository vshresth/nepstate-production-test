@extends('layouts.app')

@section('title', 'Add Testimonial')

@section('content')
    <style>
        #stars[disabled] option[value=""] {
            color: black !important;
        }
    </style>
    <br>

    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Add Testimonial
            </h2>
        </div>
        <br>
        <form action="{{ route('testimonials.return') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex" style="justify-content: space-evenly; padding:20px">
                        <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px; margin-left:20px">
                            <label for="name" class="font-medium">Name:</label>
                            <input type="text" id="name" name="name" class="input w-full border mt-2" required>
                        </div>
                        <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px;margin-right:20px ">
                            <label for="designation" class="font-medium">Designation:</label>
                            <input type="text" id="designation" name="designation" class="input w-full border mt-2"
                                required>
                        </div>
                    </div>
                    <div class="flex" style="justify-content: space-evenly; padding:20px">
                        <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px; margin-left:20px">

                            <label for="stars" class="font-medium">Rating:</label>
                            <select id="stars" name="stars" class="input w-full border mt-2" required
                                style="color: #FFD43B; font-size: 20px;">
                                {{-- <span style="color: black">
                                    <option value="" disabled selected>----------------</option>
                                </span> --}}
                                <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                <option value="3">&#9733;&#9733;&#9733;</option>
                                <option value="2">&#9733;&#9733;</option>
                                <option value="1">&#9733;</option>
                            </select>
                        </div>
                        <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px;margin-right:20px ">
                            <label for="image" class="font-medium">Image:</label>
                            <input type="file" id="image" name="image" class="input w-full border mt-2"
                                accept="image/jpeg,image/png,image/jpg*" required>
                        </div>
                    </div>
                    <div class="p-5">
                        <label for="text" class="font-medium">Text:</label>
                        <textarea id="text" name="text" class="textarea input w-full border mt-2" style="height: 200px" ></textarea>
                        @error('text')
                        <span class="errorMessage" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    
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


