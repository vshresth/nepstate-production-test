@extends('layouts.app')

@section('title')
Blogs
@endsection

@section('content')
<div class="col-span-12 mt-6">
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Blogs Request Table
        </h2>
    </div>
    <br>
        <p>
            <strong>Note: </strong> In this section, you will only see the blogs that are either pending approval or those that you have disapproved. The blogs you approve will appear in the main Blogs section.
        </p>
    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
        <table class="table table-report sm:mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Title</th>
                    <th class="whitespace-nowrap">Author</th>
                    <th class="whitespace-nowrap">Created At</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                                <tr class="intro-x">
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->author }}</td>
                                    <td>{{ $blog->created_at }}</td>
                                    <td>
                                        @if($blog->is_approved == 0)
                                            <span style="color:red;">Pending</span>
                                        @elseif($blog->is_approved == 2)
                                        <span style="color:red;">Disapproved</span>
                                        @endif
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{ route('blogs.show', ['id' => $blog->id]) }}?type=approval-request">
                                            <i class="w-4 h-4 mr-1" data-lucide="eye"></i>View
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