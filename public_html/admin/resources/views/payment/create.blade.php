@extends('layouts.app')

@section('title', 'Create Payment Plans')

@section('content')
    <br>
    <div class="intro-y col-span-12 lg:col-span-6">
        <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="intro-y box">
                <div class="flex items-center px-5 py-4 border-b border-gray-200 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Create Payment Plan
                    </h2>
                </div>
                <div class="p-5">
                    <div class="flex">
                        <div class="form-group" style="width: 50%; margin-right: 10px;">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title') }}" placeholder="Enter title" required>
                            @error('title')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="width: 50%; margin-left: 10px;">
                            <label for="months">Months</label>
                            <input type="number" name="months" id="months" class="form-control"
                                value="{{ old('months') }}" placeholder="Enter number of months" min="1"
                                max="12" required>
                            @error('months')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="flex">
                        <div class="form-group" style="width: 50%; margin-right: 10px;">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                value="{{ old('amount') }}" placeholder="Enter amount" required>
                            @error('amount')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="width: 50%; margin-left: 10px;">
                            <label for="website_home_category_section">Website Home Category Section</label>
                            <input type="number" step="0.01" name="website_home_category_section"
                                id="website_home_category_section" class="form-control"
                                value="{{ old('website_home_category_section') }}"
                                placeholder="Website Home Category Section" required>
                            @error('website_home_category_section')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="flex">
                        <div class="form-group" style="width: 50%; margin-right: 10px;">
                            <label for="website_home_banner">Website Home Banner - AD#1</label>
                            <input type="number" step="0.01" name="website_home_banner" id="website_home_banner"
                                class="form-control" value="{{ old('website_home_banner') }}"
                                placeholder="Website Home Banner" required>
                            @error('website_home_banner')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="width: 50%; margin-left: 10px;">
                            <label for="home_middle">Home Middle - AD#2</label>
                            <input type="number" step="0.01" name="home_middle" id="home_middle" class="form-control"
                                value="{{ old('home_middle') }}" placeholder="Home Middle" required>
                            @error('home_middle')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="flex">
                        <div class="form-group" style="width: 50%; margin-right: 10px;">
                            <label for="web_footer">Web Footer - AD#3</label>
                            <input type="number" step="0.01" name="web_footer" id="web_footer" class="form-control"
                                value="{{ old('web_footer') }}" placeholder="Web Footer" required>
                            @error('web_footer')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="width: 50%; margin-left: 10px;">
                            <label for="category_home_page">Category Home Page - AD#4</label>
                            <input type="number" step="0.01" name="category_home_page" id="category_home_page"
                                class="form-control" value="{{ old('category_home_page') }}"
                                placeholder="Category Home Page" required>
                            @error('category_home_page')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="flex">
                        <div class="form-group" style="width: 50%; margin-right: 10px;">
                            <label for="cat_right">Category Right - AD#5</label>
                            <input type="number" step="0.01" name="cat_right" id="cat_right" class="form-control"
                                value="{{ old('cat_right') }}" placeholder="Category Right" required>
                            @error('cat_right')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="width: 50%; margin-left: 10px;">
                            <label for="blog">Blog - AD#6</label>
                            <input type="number" step="0.01" name="blog" id="blog" class="form-control"
                                value="{{ old('blog') }}" placeholder="Blog" required>
                            @error('blog')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="flex">
                        <div class="form-group" style="width: 50%; margin-right: 10px;">
                            <label for="forum">Forum - AD#7</label>
                            <input type="number" step="0.01" name="forum" id="forum" class="form-control"
                                value="{{ old('forum') }}" placeholder="Forum" required>
                            @error('forum')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="width: 50%; margin-left: 10px;">
                            <label for="confession">Confession - AD#8</label>
                            <input type="number" step="0.01" name="confession" id="confession" class="form-control"
                                value="{{ old('confession') }}" placeholder="Confession" required>
                            @error('confession')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Select Option</option>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="btn btn-success text-white">
                            Create
                        </button>
                        <a href="{{ route('payment.index') }}" class="ml-4 btn btn-danger">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
