@extends('layouts.app')

@section('title')
    Testimonials
@endsection

@section('content')
    <br>
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Testimonials Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('testimonials.store') }}"
                    class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <br><br>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <div class="intro-y col-span-12 md:col-span-6">
                @foreach ($testimonials as $index => $testimonial)
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1"
                                style="width: 100px; height: 100px; overflow: hidden;">
                                <img alt="{{ $testimonial->name }}" style="object-fit: cover;"
                                    src="{{ $testimonial->image }}">
                            </div>

                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <div class="font-medium">{{ $testimonial->name }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ $testimonial->designation }}</div>
                                <div class="text-slate-500 text-xs mt-0.5 flex">
                                    @php
                                        $fullStars = floor($testimonial->stars);
                                        $emptyStars = 5 - $fullStars;
                                    @endphp
                                    @for ($i = 1; $i <= $fullStars; $i++)
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                    @endfor

                                    @for ($i = 1; $i <= $emptyStars; $i++)
                                        <i class="fa-regular fa-star"></i>
                                        {{-- <i class="fa-solid fa-star"></i> --}}
                                    @endfor
                                </div>
                            </div>
                            <div style="margin-left: 20px; margin-right: 20px; flex: 1;">
                                <p class="text-sm text-gray-700">{{ strip_tags($testimonial->text) }}</p>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                <a href="{{ route('testimonials.edit', $testimonial->id) }}"
                                    class="btn btn-primary py-1 px-2 mr-2">Edit</a>
                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-secondary py-1 px-2"
                                        onclick="return confirm('Are you sure you want to delete this testimonial?')">Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    @if ($index < count($testimonials) - 1)
                        <br>
                    @endif
                @endforeach
            </div>

        </div>

    </div>
@endsection
