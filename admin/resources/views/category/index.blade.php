@extends('layouts.app')

@section('title')
    Categories
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Classified Categories Table
            </h2>

        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Text</th>

                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="intro-x">
                            <td>{{ $category->title }}</td>
                            <td>{!! $category->text_lorum !!}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('category.showById', ['id' => $category->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <a class="flex items-center mr-3"
                                        href="{{ route('category.MainEditRoute', ['id' => $category->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="pencil"></i> Edit
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
