@extends('layouts.app')

@section('title')
    Blogs
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Blogs Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('blogs.create.show') }}"
                    class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">TITLE</th>
                        <th class="whitespace-nowrap">AUTHOR</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr class="intro-x">
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->author }}</td>
                            <td>
                            @if($blog->is_approved == 1)    
                                <span style="color:green;">Approved</span>
                            @endif

                            </td>
                           


                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('blogs.show', ['id' => $blog->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i>View
                                    </a>
                                    <a class="flex items-center mr-3" href="{{ route('blogs.edit.show', $blog->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                    <form action="{{ route('blogs.destroy', ['id' => $blog->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this blog ?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
