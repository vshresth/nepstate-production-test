@extends('layouts.app')

@section('title')
    Confessions
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Confession Table
            </h2>

        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Author</th>

                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($confessions as $confession)
                        <tr class="intro-x">
                            <td>{{ $confession->title }}</td>
                            <td>{{ $confession->author }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('confessions.show', ['id' => $confession->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <form action="{{ route('confessions.destroy', ['id' => $confession->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this confession?')">
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
