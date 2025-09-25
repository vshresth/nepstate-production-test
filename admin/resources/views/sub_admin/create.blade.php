@extends('layouts.app')

@section('title')
    Create User
@endsection

@section('content')
    <br>
    <form method="POST" action="{{ route('subadmin-store') }}">
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
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ old('username') }}" placeholder="Enter your username" required>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="Enter your name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" placeholder="example@example.com" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter your password" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Select option</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <br>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1 bg-gray-200 p-4">

                            <div class="form-check mt-2">
                                <input id="Dashboard" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Dashboard">
                                <label class="form-check-label" for="Dashboard">Dashboard</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>

                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Users" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Users">
                                <label class="form-check-label" for="Users">Users</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Countries" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Countries">
                                <label class="form-check-label" for="Countries">Countries</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Classified_Categories" class="form-check-input" name="permissions[]"
                                    type="checkbox" value="Classified_Categories">
                                <label class="form-check-label" for="Classified_Categories">Classified Categories</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Classified" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Classified">
                                <label class="form-check-label" for="Classified">Classified</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Advertisment" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Advertisment">
                                <label class="form-check-label" for="Advertisment">Advertisment</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Payment_Plans" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Payment_Plans">
                                <label class="form-check-label" for="Payment_Plans">Payment Plans</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Forum" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Forum">
                                <label class="form-check-label" for="Forum">Forum</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Confession" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Confession">
                                <label class="form-check-label" for="Confession">Confession</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Blogs" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Blogs">
                                <label class="form-check-label" for="Blogs">Blogs</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="FAQS" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="FAQS">
                                <label class="form-check-label" for="FAQS">FAQS</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Static_Page" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Static_Page">
                                <label class="form-check-label" for="Static_Page">Static Page</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Testimonials" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Testimonials">
                                <label class="form-check-label" for="Testimonials">Testimonials</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Google_Ads" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Google_Ads">
                                <label class="form-check-label" for="Google_Ads">Google Ads</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="All_Comments" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="All_Comments">
                                <label class="form-check-label" for="All_Comments">All Comments</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Coupons" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Coupons">
                                <label class="form-check-label" for="Coupons">Coupons</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Notifications" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Notifications">
                                <label class="form-check-label" for="Notifications">Notifications</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Settings" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Settings">
                                <label class="form-check-label" for="Settings">Settings</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Reviews" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Reviews">
                                <label class="form-check-label" for="Reviews">Reviews</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                        <div class="col-span-1 bg-gray-200 p-4">
                            <div class="form-check mt-2">
                                <input id="Blogs_Request" class="form-check-input" name="permissions[]" type="checkbox"
                                    value="Blogs_Request">
                                <label class="form-check-label" for="Blogs_Request">Blogs Request</label>
                            </div>
                            <div class="form-check mt-2"> </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white mt-4">
                        Create
                    </button>
                    <a href="{{ route('subadmin-index') }}" class="btn btn-danger">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
