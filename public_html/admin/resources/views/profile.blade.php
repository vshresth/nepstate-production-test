@extends('layouts.app')

@section('title')
    Admin Profile
@endsection

@section('content')
    @if (Session::has('success'))
        <br>
        <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i
                data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('success') }} <button type="button"
                class="btn-close" data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    @endif
    <div class="intro-y mt-5 flex justify-center">
        <div style="width: 60%;margin-top:30px">
            <div class="box p-5 rounded-md">
                <div
                    class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate flex items-center">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                        Update Admin Profile
                    </div>
                </div>

                <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full lg:w-1/3 px-4 mb-4">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="Profile Photo" class="rounded-full" src="{{ $admin->admin_profile_pic }}"
                                    accept="image/jpeg,image/png,image/jpg">
                                <label for="admin_profile_pic"
                                    class="cursor-pointer absolute bottom-0 right-0 bg-white rounded-full p-2">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="admin_profile_pic" accept="image/jpeg,image/png,image/jpg" name="admin_profile_pic" class="mt-2 hidden">
                            </div>
                        </div>

                        <div class="w-full lg:w-2/3 px-4 mb-4">
                            <div class="w-full mb-4">
                                <input type="text" name="name" value="{{ $admin->name }}" class="input w-full border"
                                    placeholder="Admin name" required>
                            </div>
                            <div class="w-full mb-4">
                                <input type="email" name="email" value="{{ $admin->email }}" class="input w-full border"
                                    placeholder="Admin email" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-success text-white">Update Profile</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
