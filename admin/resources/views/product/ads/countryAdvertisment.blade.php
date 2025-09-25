@extends('layouts.app')

@section('title')
    Admin Country Advertisment
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        @if (Session::has('success'))
            <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i data-lucide=""
                    class="w-6 h-6 mr-2"></i> {{ Session::get('success') }} <button type="button" class="btn-close"
                    data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i
                    data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('error') }} <button type="button"
                    class="btn-close" data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        <br>
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
            Country Advertisment
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('ad_create') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New Advertisment
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Title</th>
                      
                        <th class="whitespace-nowrap">Flag</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr class="intro-x">
                            <td>{{ $country->title }}</td>
                            
                            <td>
                                @if ($country->flag)
                                    <img src="{{ $country->flag }}" alt="Flag"
                                        style="max-width: 50px; max-height: 50px;">
                                @else
                                    No flag uploaded
                                @endif
                            </td>
                            <td class="table-report__action w-56">
    <div class="flex justify-center items-center">
        <a class="flex items-center mr-3" style="color:gren;" href="{{ route('product_ad', ['id' => $country->id, 'type' => 'active']) }}">
           Active Ads
        </a>

        <a class="flex items-center mr-3" style="color:red;" href="{{ route('product_ad', ['id' => $country->id,'type' => 'expired']) }}">
           Expired Ads
        </a>
    </div>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
