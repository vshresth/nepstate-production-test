@extends('layouts.app')

@section('title')
    Edit User
@endsection

@section('content')
    <br>
    <form method="POST" action="{{ route('subadmin-update', $subAdmin->id) }}">
        @csrf
        @method('PUT')

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Edit
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ $subAdmin->username }}" placeholder="Enter your username" required disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $subAdmin->name }}" placeholder="Enter your name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $subAdmin->email }}" placeholder="example@example.com" required disabled>
                            </div>
                            <br>
                            {{-- <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Enter your password" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                        </div>
                        <br>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" {{ $subAdmin->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $subAdmin->status == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>

                    <?php
                    $permissions = $subAdmin->permissions;
                    $userPermissions = $permissions ? explode(',', $permissions) : [];
                    // $permissionList = str_replace('_', ' ', $permissionList);
                    
                    $permissionList = ['Dashboard', 'Users', 'Countries', 'Classified Categories', 'Classified', 'Advertisment', 'Payment Plans', 'Forum', 'Confession', 'Blogs', 'FAQS', 'Static Page', 'Testimonials', 'Google Ads', 'All Comments', 'Coupons', 'Notifications', 'Settings','Reviews','Blogs_Request'];
                    $permissionValue = ['Dashboard', 'Users', 'Countries', 'Classified_Categories', 'Classified', 'Advertisment', 'Payment_Plans', 'Forum', 'Confession', 'Blogs', 'FAQS', 'Static_Page', 'Testimonials', 'Google_Ads', 'All_Comments', 'Coupons', 'Notifications', 'Settings','Reviews','Blogs_Request'];


                    ?>

                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($permissionList as $key => $permission)
                          
                            <div class="col-span-1 bg-gray-200 p-4">
                                <div class="form-check mt-2">
                                    <input id="{{ $permission }}" class="form-check-input" name="permissions[]"
                                        type="checkbox" value="{{ $permissionValue[$key] }}"
                                        {{ in_array($permissionValue[$key], $userPermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $permission }}">{{ $permission }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary text-white mt-4">
                        Update
                    </button>
                    <a href="{{ route('subadmin-index') }}" class="btn btn-danger">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
