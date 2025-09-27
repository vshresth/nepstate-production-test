@extends('layouts.app')

@section('title')
    Edit FAQ
@endsection

@section('content')
    <br>
    <form method="POST" action="{{ route('faqs.update', $faq->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Edit
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Question</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $faq->title }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Answer</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter your address">{{ old('description', $faq->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                            
                            
                            
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ $faq->status == 2 ? 'selected' : '' }}>Disabled</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success text-white">
                                Update
                            </button>
                            <a href="{{ route('faqs.index') }}" class="btn btn-danger">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
