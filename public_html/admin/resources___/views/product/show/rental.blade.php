@extends('layouts.app')

@section('title')
    Roomates & Rental {{ $product->title }}
@endsection

@section('content')
    <br>
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Roomates & Rental
        </h2>

    </div>
    <div class="intro-y  mt-5">
        <div class="grid col-span-4 gap-3 lg:col-span-4 2xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div
                    class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">User Info</div>
                    <a href="{{ url('/show-classifer-Roomates&Rental') }}"
                        class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
                </div>
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="User Profile" class="rounded-full" src="{{ $users->profile_pic }}">

                            </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                                    {{ $users->name }}</div>
                                <div class="text-slate-500">{{ $users->username }}</div>
                            </div>
                        </div>
                        <div
                            class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3">User Details</div>
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail"
                                        class="w-4 h-4 mr-2"></i> {{ $users->email }}</div>
                                {{-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone"
                                        class="w-4 h-4 mr-2"></i> {{ $users->phone }} </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="home"
                                        class="w-4 h-4 mr-2"></i> {{ $users->address }} </div> --}}
                                {{-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="map-pin"
                                        class="w-4 h-4 mr-2"></i> {{ $city->title }} </div>--}}
                                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                            <i data-lucide="globe" class="w-4 h-4 mr-2"></i>
                                            {{ $country->title ?? 'Country Does Not Exist' }}
                                        </div>
                                        

                            </div>
                        </div>
                        <div
                            class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3">Product info</div>
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"><i data-lucide="dollar-sign"
                                        class="w-4 h-4 mr-2"></i> Amount Paid: {{ $product->amount_paid }}</div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"><i data-lucide="clock"
                                        class="w-4 h-4 mr-2"></i> Created At: {{ $product->created_at }} </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="x-circle"
                                        class="w-4 h-4 mr-2"></i> Expiry Date: {{ $product->expiry_date }} </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="shield" class="w-4 h-4 text-slate-500 mr-2"></i>
                                    <span>Status:</span>
                                    @if ($product->status == 1)
                                        <span class="flex items-center bg-success/20 text-success rounded px-2 ml-2">
                                            <span class="mr-1">Active</span>
                                            <i data-loading-icon="puff" data-color="white" class="w-4 h-4"></i>
                                        </span>
                                    @elseif($product->status == 2)
                                        <span class="flex items-center bg-danger/20 text-danger rounded px-2 ml-2">
                                            <span class="mr-1">Disabled</span>
                                            <i data-loading-icon="three-dots" data-color="1a202c" class="w-4 h-4"></i>
                                        </span>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- -----------------------------------------------------------------------------------------------------------------------  --}}



        </div>
        <br>
        <div class="col-span-12 lg:col-span-7 2xl:col-span-8">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Additional Details</div>
                    <div class="flex items-center ml-auto text-primary" style="font-weight: bold; font-size:x-large;">
                        {{ $product->title }} </div>

                </div>
                <div class="overflow-auto lg:overflow-visible -mt-3">
                    <table class="table table-striped">
                        <thead>

                        </thead>
                        <tbody>
                            @foreach ($formattedJson as $key => $value)
                                @if (!empty($value))
                                    <tr>
                                        <td class="!py-4">
                                            <div class="flex items-center">
                                                {{ $key }}
                                            </div>
                                        </td>
                                        <td class="text-right"> {{ is_array($value) ? implode(', ', $value) : $value }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
        <div class="box p-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium text-base truncate">Gallery Images</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($galleryImage as $galleryimg)
                    <div style="position: relative; width: 100%; padding-bottom: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="{{ $galleryimg->image }}" alt="Gallery Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <br>
    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
        <div class="box p-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium text-base truncate">Images</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($simpleImage as $simpleimg)
                    <div style="position: relative; width: 100%; padding-bottom: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="{{ $simpleimg->image }}" alt="Simple Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
