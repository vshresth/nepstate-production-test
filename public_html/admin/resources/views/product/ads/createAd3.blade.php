@extends('layouts.app')

@section('title')
    Advertisement Create
@endsection

@section('content')
    <br>
    <form method="POST" action="{{ route('save3') }}" enctype="multipart/form-data">
        @csrf

        <div class="intro-y col-span-12 lg:col-span-6" style="width: 60%; margin-left:20%;margin-right:20%;">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        AD # 3
                    </h2>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" name="link" id="link" class="form-control"
                                    value="{{ old('link') }}" required>
                                @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="country_id">Country</label>
                                <select name="country_id" id="country_id" class="form-control" required>
                                    <option value="">Select Country</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="ad_expires">Expiry Date</label>
                                <input type="date" name="ad_expires" id="ad_expires" class="form-control"
                                    value="{{ old('ad_expires') }}" required>
                                @error('ad_expires')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" accept="image/jpeg,image/png,image/jpg*" name="image" id="image"
                                    class="form-control" required>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                        <button type="submit" class="btn btn-success text-white">
                            Create
                        </button>
                        <a href="{{ url('/countryAdvertisment') }}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>
                </div>
                <script>
                    var adFor = localStorage.getItem('ad_for');
                    document.getElementById('ad_for').value = adFor;
                </script>
            </div>
        </div>
    </form>
@endsection
