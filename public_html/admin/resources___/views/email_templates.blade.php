@extends('layouts.app')

@section('title')
    Email Templates
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Email Templates
            </h2>
        </div>
        <br>
        <div class="intro-y mt-8 sm:mt-0">
            <form method="POST" action="{{ route('emailTemplateUpdate') }}">
                @csrf

                @if (session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                <div style="margin-bottom: 1rem;">
                    @error('name')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $emailTemplate->name ?? '') }}">

                    <br><br>
                    
                @error('content')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem;" rows="10">{{ old('content', $emailTemplate->content ?? '') }}</textarea>
   <br>
   
                    <div class="flex" style="justify-content: space-evenly">
                        <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px ">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="text" id="twitter" name="twitter" class="form-control" value="{{ old('twitter', $emailTemplate->twitter ?? '') }}">
                        </div>
                        <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-control" value="{{ old('facebook', $emailTemplate->facebook ?? '') }}">
                            </div>
                        </div>
                                 
                    
                    <br>
                    <div class="flex" style="justify-content: space-evenly">
                        <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px ">
                        <label for="pinterest" class="form-label">Pinterest</label>
                        <input type="text" id="pinterest" name="pinterest" class="form-control" value="{{ old('pinterest', $emailTemplate->pinterest ?? '') }}">
                    </div>
                        <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                        <label for="linkedin" class="form-label">LinkedIn</label>
                        <input type="text" id="linkedin" name="linkedin" class="form-control" value="{{ old('linkedin', $emailTemplate->linkedin ?? '') }}">
                    </div>
                        </div>

                   <br>
                   <div class="flex" style="justify-content: space-evenly">
                        <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px ">
                        <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" id="instagram" name="instagram" class="form-control" value="{{ old('instagram', $emailTemplate->instagram ?? '') }}">
                </div>
                         </div>

               
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
