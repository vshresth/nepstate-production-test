@extends('layouts.app')

@section('title')
    All Comments Page
@endsection

@section('content')
    @if (Session::has('success'))
        <br>
        <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i
                data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('success') }} <button type="button"
                class="btn-close" data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <br>
    @endif
    <div class="intro-y news xl:w-3/5 p-5 box mt-8" style="background-color: #f3f4f6;">

        <div class="col-span-12 mt-2">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Blog Comments
                </h2>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Blog Title</th>
                            <th class="whitespace-nowrap">User Name</th>
                            <th class="whitespace-nowrap">Comment</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogCommentsData as $comment)
                            <tr class="intro-x">
                                <td style="width: 25%">{{ $comment['title'] }}</td>
                                <td style="width: 20%">{{ $comment['user_name'] }}</td>
                                <td style="width: 35%">{{ $comment['comment'] }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <form action="{{ route('delete.comment.page', ['id' => $comment['id']]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this blog comment?')">
                                                <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete Comment
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
    </div>
    <br>
    
    {{-- confession  table --}}
    <div class="intro-y news xl:w-3/5 p-5 box mt-8" style="background-color: #f3f4f6;">

        <div class="col-span-12 mt-2">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Confession Comments
                </h2>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Confession Title</th>
                            <th class="whitespace-nowrap">User Name</th>
                            <th class="whitespace-nowrap">Comment</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($confessionCommentsData as $comment)
                            <tr class="intro-x">
                                <td style="width: 25%">{{ $comment['title'] }}</td>
                                <td style="width: 20%">{{ $comment['commenter_name'] }}</td>
                                <td style="width: 35%">{{ $comment['comment'] }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <form action="{{ route('delete.comment.page', ['id' => $comment['id']]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this confession comment?')">
                                                <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete Comment
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
    </div>
    <br>
    {{-- forum table --}}
    <div class="intro-y news xl:w-3/5 p-5 box mt-8" style="background-color: #f3f4f6;">
        <div class="col-span-12 mt-2">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Forum Comments
                </h2>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Forum Title</th>
                            <th class="whitespace-nowrap">User Name</th>
                            <th class="whitespace-nowrap">Comment</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forumCommentsData as $comment)
                            <tr class="intro-x">
                                <td style="width: 25%">{{ $comment['title'] }}</td>
                                <td style="width: 20%">{{ $comment['commenter_name'] }}</td>
                                <td style="width: 35%">{{ $comment['comment'] }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <form action="{{ route('delete.comment.page', ['id' => $comment['id']]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this forum comment?')">
                                                <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete Comment
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
    </div>
    
    
    <br>
@endsection
