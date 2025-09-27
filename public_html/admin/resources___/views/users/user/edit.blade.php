@extends('layouts.app')

@section('title')
    Edit User
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
                <form method="POST" action="{{ route('users.user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                            placeholder="Enter your name" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ $user->username }}" placeholder="Enter your username" required>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                            placeholder="example@example.com" required disabled>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Disabled
                            </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="country_id">Country</label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>{{ $country->title }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="mt-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}"
                            placeholder="Enter your phone number (e.g., 1234567890)">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    {{-- <div class="mt-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ $user->address }}" placeholder="Enter your address">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="mt-3">
                        <label for="profile_pic" class="form-label">Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control-file"
                            accept="image/jpeg,image/png,image/jpg">
                        @error('profile_pic')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if ($user->profile_pic)
                            <img src="{{ $user->profile_pic }}" alt="Profile Picture"
                                style="max-width: 100px; margin-top: 10px;">
                        @endif
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success text-white">
                        Update
                    </button>
                    <a href="{{ route('users.user.index') }}" class="btn btn-danger">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
