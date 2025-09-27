@extends('layouts.app')

@section('title')
    Admin
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
                Countries Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('countries.create') }}"
                    class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Code</th>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="whitespace-nowrap">Flag</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr class="intro-x">
                            <td>{{ $country->code }}</td>
                            <td>{{ $country->title }}</td>
                            <td>
                                @if ($country->status == 1)
                                    <span class="mr-1">Default</span>
                                @elseif($country->status == 0)
                                    <span class="mr-1">Not Default</span>
                                @endif
                            </td>
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
                                    <a class="flex items-center mr-3" href="{{ route('countries.show', $country->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <a class="flex items-center mr-3" href="{{ route('countries.edit', $country->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                   @if( $country->status == 0)
                                    <form action="{{ route('countries.destroy', $country->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this country?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
