@extends('layouts.app')

@section('title')
    Google Ads Placeholder
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Google Ads Placeholder
            </h2>
        </div>
        <br>
        <div class="intro-y mt-8 sm:mt-0">
            <form method="POST" action="{{ route('googleAds.update') }}">
                @csrf
                <div style="margin-bottom: 1rem;">
                    {{-- <label for="description" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Google Ads Description</label> --}}
                    <textarea id="description" name="description" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem;" rows="10">{{ $googleAds }}</textarea>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

