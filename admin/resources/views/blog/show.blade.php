@extends('layouts.app')

@section('title')
    Blog Details
@endsection

@section('content')
    <div class="intro-y news xl:w-3/5 p-5 box mt-8">
        <div class="row bg-title">
            <div class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium text-base truncate"> <strong>Author:</strong>
                    @if (empty($blog->author))
                        No Author
                    @else
                        {{ $blog->author }}
                    @endif
                </div>
                @if(request()->type == 'approval-request')
                <a href="{{ url('/all-approval') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
                @else
                <a href="{{ url('/blogs') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
                @endif
            </div>
        </div>
        <div class="intro-y text-slate-600 dark:text-slate-500 mt-3 text-xs sm:text-sm">{{ $blog->created_at }}<span
                class="mx-1"></span><span class="mx-1">•</span>

                <div style="float:right;">
                    @if($blog->is_approved == 0)
                    <button class="btn btn-success text-white"
                        onclick="if(confirm('Are you sure you want to approve this blog?')) { 
                            window.location.href='{{ route('approve.blog', ['id' => $blog->id]) }}'; 
                        }">
                        Approve
                    </button>

                    <button class="btn btn-danger"
                        onclick="if(confirm('Are you sure you want to reject this blog?')) { 
                            window.location.href='{{ route('reject.blog', ['id' => $blog->id]) }}'; 
                        }">
                        Reject
                    </button>
                    @elseif($blog->is_approved == 1)
                    <span style="color:green;">Approved</span>
                    @elseif($blog->is_approved == 2)
                    <span style="color:red;">Disapproved</span>

                    @endif
                </div>
            </div>

            
        <div class="p-5">
            <div class="">
               
                @if ($blog->image)
                    <img alt="Ad Photo" class="" src="{{ $blog->image }}">
                @else
                    <a href="default_logo">
                        <img alt="Default Image" class="" style="height: 100%; width:100%"
                            src="{{ asset('asset/images/bodybg.jpg') }}">
                    </a>
                @endif
            </div>
            <div class="p-5">

                <div class="block font-medium text-base mt-5">Title:<span class="text-slate-600 dark:text-slate-500 mt-2">
                        <strong></strong>
                            {{ $blog->title }}
                    </span>
                </div>
                
                <div class="block font-medium text-base mt-5">Author <span
                        class="text-slate-600 dark:text-slate-500 mt-2"><strong>:</strong>
                            {{ $blog->author }}
                        
                    </span>
                </div>
            </div>
        </div>
        <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="w-full flex text-slate-500 text-xs sm:text-sm">
                <div class="block font-medium text-base mt-5" target="_blank">
                    <span class="text-slate-600 dark:text-slate-500 mt-2"></span>
                </div>
                <div class="">
                    <div class="description">
                        <iframe srcdoc="{{ $blog->description }}" style="width: 60vw; height: 100vh; border: none; overflow: hidden;"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <strong>Tags:</strong>
            @if (empty($blog->tags))
                null
            @else
                <?php
                $tags = explode(',', $blog->tags);
                foreach ($tags as $tag) {
                    echo '<span style="display: inline-block; padding: 5px 10px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 5px; margin-right: 5px;">' . trim($tag) . '</span>';
                }
                ?>
            @endif
        </div>
        <br>
        <div class="mb-3">
            <strong>Comments:</strong>

            @if (Session::has('comment_delete'))
                <br>
                <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i
                        data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('comment_delete') }} <button
                        type="button" class="btn-close" data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x"
                            class="w-4 h-4"></i>
                    </button>
                </div>
                <br>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blog->comments as $comment)
                        <tr>
                            <td>{{ $comment->user->name ?? 'Unknown User' }}</td>
                            <td>{{ $comment->comment ?? 'No Comment Provided' }}</td>
                            <td>
                                <form action="{{ route('blogs.comments.destroy', ['id' => $comment->id]) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this comment?')">
                                        <i class="fa fa-trash" aria-hidden="true" style="margin-right: 10px"></i> Delete
                                        Comment</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
