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
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">TITLE</th>
                        <th class="whitespace-nowrap">AUTHOR</th>
                        <th class="whitespace-nowrap">SLUG</th>
                        <th class="whitespace-nowrap">TAG</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr class="intro-x">
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->author }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td>
                                <?php
                                $tags = explode(',', $blog->tags);
                                foreach ($tags as $tag) {
                                    echo '<span style="display: inline-block; padding: 5px 10px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 5px; margin-right: 5px; margin-bottom:5px">' . trim($tag) . '</span>';
                                }
                                ?>
                            </td>


                            <td class="table-report__action w-56">
    <div class="flex justify-center items-center">
        @if ($blog->is_approved == 0)
            <a class="flex items-center mr-3" href="{{ route('approve.blog', ['id' => $blog->id]) }}"
               onclick="return confirm('Are you sure you want to approve this blog?')">
                <i class="w-4 h-4 mr-1" data-lucide="check"></i>Approve
            </a>
        @else
            <span class="badge bg-success">Approved</span>
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
