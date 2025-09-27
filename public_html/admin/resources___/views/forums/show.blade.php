@extends('layouts.app')

@section('title')
    Show Forum
@endsection

@section('content')
    <div class="intro-y news xl:w-3/5 p-5 box mt-8">
        <div class="row bg-title">
            <div class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium text-base truncate"> <strong>Author:</strong>
                    @if (empty($confession->author))
                        No Author
                    @else
                        {{ $confession->author }}
                    @endif
                </div>
                <a href="{{ route('typeforums.index') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
            </div>
        </div>
        <div class="intro-y text-slate-600 dark:text-slate-500 mt-3 text-xs sm:text-sm">{{ $confession->created_at }}<span
                class="mx-1"> </div>

        <div class="p-5">
            @if (!empty($confession->image))
                <div class="h-40 2xl:h-56 image-fit">
                    <img alt="Ad Photo" class="rounded-md" src="{{ $confession->image }}">
                </div>
            @endif

            <div class="p-5">
                <div class="block font-medium text-base mt-5">Title:<span class="text-slate-600 dark:text-slate-500 mt-2">
                        <strong></strong>
                        @if (empty($confession->title))
                            No Title
                        @else
                            {{ $confession->title }}
                        @endif
                    </span>
                </div>
                <div class="block font-medium text-base mt-5">Slug <span
                        class="text-slate-600 dark:text-slate-500 mt-2"><strong>:</strong>
                        @if (empty($confession->slug))
                            null
                        @else
                            {{ $confession->slug }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="w-full flex text-slate-500 text-xs sm:text-sm">
                <div class="block font-medium text-base mt-5" target="_blank">
                    <span class="text-slate-600 dark:text-slate-500 mt-2"></span>
                </div>
                <div class="text-slate-600 dark:text-slate-500 mt-2">
                    <div class="description">
                        @php
                            $description = $confession->description ?? 'null';
                            $lines = explode("\n", $description);
                            echo implode("\n", array_slice($lines, 0, 5));
                        @endphp
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <strong>Tags:</strong>
            @if (empty($confession->tags))
                null
            @else
                <?php
                $tags = explode(',', $confession->tags);
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
                <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> 
                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> 
                    {{ Session::get('comment_delete') }} 
                    <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="lock"> 
                        <i data-lucide="x" class="w-4 h-4"></i>
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
                    @foreach ($confession->confession_comments as $comment)
                        <tr>
                            <td>{{ $comment->commenter_name ?? 'Unknown User' }}</td>
                            <td>{{ $comment->comment ?? 'No Comment Provided' }}</td>
                            <td>
                                <form action="{{ route('confessions.comments.destroy', ['id' => $comment->id]) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this comment?')">
                                        <i class="fa fa-trash" aria-hidden="true" style="margin-right: 10px"></i> Delete
                                        Comment
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
