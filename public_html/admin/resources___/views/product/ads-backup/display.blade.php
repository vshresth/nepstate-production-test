@extends('layouts.app')

@section('title')
    Advertisement Details
@endsection

@section('content')
    <br>
    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
            <div class="ml-3 mr-auto">
                <div class="font-medium">
                    @foreach ($users as $user)
                        @if ($user->id === $advertisement->user_id)
                            {{ $user->name }}
                        @endif
                    @endforeach
                </div>
                {{-- <a href="" class="font-medium">Brad Pitt</a>  --}}
                <div class="flex text-slate-500 truncate text-xs mt-0.5">
                    <div class="text-primary inline-block truncate">{{ $advertisement->category }}</div> <span
                        class="mx-1">•</span> {{ $advertisement->created_at }}
                </div>
            </div>

            <a href="{{ route('product_ad') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>

        </div>
        <div class="p-5">
            <div class="h-40 2xl:h-56 image-fit">
                {{-- <img alt="Ad Photo" class="rounded-md" src="{{ $advertisement->image }}"> --}}
                <img alt="Ad Photo" class="rounded-md" src="{{ $advertisement->image }}">
            </div>
            <div class="p-5">

                <div class="block font-medium text-base mt-5">Advertisement For: <span
                        class="text-slate-600 dark:text-slate-500 mt-2">{{ str_replace(['_', '-'], ' ', $advertisement->ad_for) }}</span>
                </div>
                <div class="block font-medium text-base mt-5">Advertisement Location: <span
                        class="text-slate-600 dark:text-slate-500 mt-2">{{ str_replace(['_', '-'], ' ', $advertisement->ad_location) }}</span>
                </div>
            </div>
        </div>

        <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="w-full flex text-slate-500 text-xs sm:text-sm">
                {{-- <div class="mr-2"> Expiry: <span class="font-medium">{{ $advertisement->ad_expires }}</span> </div> --}}
                <div class="ml-auto" title="Country"><span class="font-medium">
                        @foreach ($countries as $country)
                            @if ($country->id === $advertisement->country_id)
                                {{ $country->title }}
                            @endif
                        @endforeach
                    </span> </div>
            </div>
            <a href="{{ $advertisement->link }}" class="block font-medium text-base mt-5" target="_blank">
                Link: <span class="text-slate-600 dark:text-slate-500 mt-2">{{ $advertisement->link }}</span>
            </a>
            <div class="text-slate-600 dark:text-slate-500 mt-2">It is a long established fact that a reader will be
                distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
        </div>
    </div>
@endsection
