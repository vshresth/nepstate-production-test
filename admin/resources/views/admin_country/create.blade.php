@extends('layouts.app')

@section('title')
    Create Countries
@endsection

@section('content')
    <br>
    <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="code">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" value="{{ old('code') }}"
                                    placeholder="Enter country code" required>
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}"
                                    placeholder="Enter country title" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>

                        </div>
                        <br>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Photo</label>
                                <input type="file" class="form-control-file @error('flag') is-invalid @enderror"
                                    id="flag" name="flag" accept="image/jpeg,image/png,image/jpg">
                                <br>
                                @error('flag')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Select Option</option>

                                    <option value="1">Deafult</option>
                                    <option value="0">Not Default</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                               <label for="paragraph">Service Fee In Percentage</label>
                                <input type="number" class="form-control" name="services_fee" step="0.01" min="0">
                            </div>
                            <br>
                            <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                                <label for="fee_status">Service Fee Status</label>
                                <input type="checkbox" name="fee_status" value="1" id="fee_status">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-success text-white">
                                Create
                            </button>
                            <a href="{{ route('countries.index') }}" class="btn btn-danger">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
    </form>
@endsection
