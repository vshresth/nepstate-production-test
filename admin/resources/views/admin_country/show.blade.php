@extends('layouts.app')

@section('title')
    Show
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
        
        <div
                    class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate flex items-center">
                        <i data-lucide="globe" class="w-4 h-4 mr-2"></i>
                        {{$country->title}}
                    </div>
                    <a href="{{ route('countries.index') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
                </div>
    </div>
    <table class="table table-report sm:mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">Classified Categories</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="intro-x">
                    <td>{{ $category->title }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('CategoryInfo.show', ['country' => $country->id, 'slug' => $category->slug]) }}">
                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View Info
                            </a>
                            
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table table-report sm:mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">Users Registered</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="intro-x">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('user.show', $user->id) }}">
                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View User Info
                            </a>
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
