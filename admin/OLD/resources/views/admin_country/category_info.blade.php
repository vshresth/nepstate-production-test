@extends('layouts.app')

@section('title')
    Product Information
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        @if (Session::has('success'))
            <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert">
                <i data-lucide="" class="w-6 h-6 mr-2"></i> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="lock">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert">
                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="lock">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        <br>

        <div class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
            <div class="font-medium text-base truncate flex items-center">
                <i data-lucide="globe" class="w-4 h-4 mr-2"></i>
                {{ $country->title ?? 'Country Not Found' }}
            </div>
            <a href="{{ url()->previous() }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
        </div>
        <div class="font-medium text-base truncate flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            {{ $category->title ?? 'Category Not Found' }}
        </div>
        @if($products->isEmpty())
            <p>No Record found for this category in this country.</p>
        @else
            <table class="table table-report sm:mt-2">
                                <tbody>
                    @foreach ($products as $product)
                        <tr class="intro-x">
                            <td>{{ $product->title ?? 'No Title Available' }}</td>
                            <td>{{ $product->slug ?? 'No Sug Available' }}</td>
                            <td>
                                <div class="flex justify-center items-center">
                                    @php
                                        $slug = $category->slug;
                                    @endphp
                                    @switch($slug)
                                        @case('events')
                                            <a class="flex items-center mr-3" href="{{ route('events.show', ['id' => $product->id]) }}">
                                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View 
                                            </a>
                                            @break
                                        @case('jobs')
                                            <a class="flex items-center mr-3" href="{{ route('job.show', ['id' => $product->id]) }}">
                                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View 
                                            </a>
                                            @break
                                        @case('services')
                                            <a class="flex items-center mr-3" href="{{ route('service.show', ['id' => $product->id]) }}">
                                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View 
                                            </a>
                                            @break
                                        @case('roomates-rentals')
                                            <a class="flex items-center mr-3" href="{{ route('rental.show', ['id' => $product->id]) }}">
                                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View 
                                            </a>
                                            @break
                                        @case('it-trainings')
                                            <a class="flex items-center mr-3" href="{{ route('train.show', ['id' => $product->id]) }}">
                                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View 
                                            </a>
                                            @break
                                        @default
                                            <span>Unknown category</span>
                                    @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
