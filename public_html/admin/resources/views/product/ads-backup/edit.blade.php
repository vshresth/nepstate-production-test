@extends('layouts.app')

@section('title')
    Edit Advertisement
@endsection

@section('content')
    <br>
    <form method="POST" action="{{ route('ad_update', $advertisement->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="intro-y col-span-12 lg:col-span-6" style="width: 60%; margin-left:20%;margin-right:20%;">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Edit Advertisement
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ad_for">Advertisement For</label>
                                <input type="text" name="ad_for" id="ad_for" class="form-control"
                                    value="{{ session('old_ad_for') ?? $advertisement->ad_for }}" disabled>
                                @error('ad_for')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" name="link" id="link" class="form-control"
                                    value="{{ old('link', $advertisement->link) }}" required>
                                @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            {{-- <div class="form-group">
                                <label for="ad_expires">Expiry Date</label>
                                <input type="date" name="ad_expires" id="ad_expires" class="form-control" value="{{ old('ad_expires', $advertisement->ad_expires) }}" required>
                                @error('ad_expires')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="col-form-label">Category</label>
                                    <select id="category" class="form-control" name="category">
                                        <option value="">Select Category</option>
                                        <option value="events" {{ $advertisement->category === 'events' ? 'selected' : '' }}>Events</option>
                                        <option value="jobs" {{ $advertisement->category === 'jobs' ? 'selected' : '' }}>Jobs</option>
                                        <option value="roommates-rentals" {{ $advertisement->category === 'roommates-rentals' ? 'selected' : '' }}>Roommates & Rentals</option>
                                        <option value="it-trainings" {{ $advertisement->category === 'it-trainings' ? 'selected' : '' }}>IT Trainings</option>
                                        <option value="services" {{ $advertisement->category === 'services' ? 'selected' : '' }}>Services</option>
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" accept="image/jpeg,image/png,image/jpg*" name="image" id="image" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            @if ($advertisement->image)
                                <img src="{{ $advertisement->image }}" alt="Advertisement Image" style="max-width: 200px;">
                            @else
                                <p>No image uploaded.</p>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success text-white">Update</button>
                            <a href="{{ route('product_ad') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
