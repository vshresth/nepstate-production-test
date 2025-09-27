@extends('layouts.app')

@section('title')
    Edit Countries
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
                <form action="{{ route('countries.update', $country->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                            name="code" value="{{ $country->code }}">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ $country->title }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="flag" class="form-label">Photo</label>
                        <input type="file" name="flag" id="flag"
                            class="form-control-file @error('flag') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/jpg">
                        @error('flag')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if ($country->flag)
                            <img src="{{ $country->flag }}" alt="Flag" style="max-width: 100px; margin-top: 10px;">
                        @endif
                    </div>
                    <div class="mt-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Select Option</option>

                            <option value="1" {{ $country->status == 1 ? 'selected' : '' }}>Default</option>
                            <option value="0" {{ $country->status == 0 ? 'selected' : '' }}>Not Default
                            </option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success text-white">
                        Update
                    </button>
                    <a href="{{ route('countries.index') }}" class="btn btn-danger">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
