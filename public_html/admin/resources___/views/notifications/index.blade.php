@extends('layouts.app')

@section('title')
    Notifications
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        @if (Session::has('success'))
            <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert">
                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="lock">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">User</th>
                        <th class="whitespace-nowrap">Type</th>
                        <th class="whitespace-nowrap">Text</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr class="intro-x">
                        <td>{{ $notification->user ? $notification->user->name : 'None' }}</td>
                            <td>{{ $notification->type }}</td>
                            <td>{{ $notification->text }}</td>
                            <!-- <td>{{ $notification->seen ? 'Yes' : 'No' }}</td> -->
                            <td class="table-report__action w-15">
                                <div class="flex justify-center items-center">
                                
                                <button type="submit" class="mr-1 px-2 py-1 text-black">

                                        @if($notification->notification_indicate == 'blog')
                                            <a href="{{ url('/blog-view') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'confessions')
                                        <a href="{{ url('/type-confessions') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'forums')
                                        <a href="{{ url('/type-forums') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'events')
                                        <a href="{{ url('/show-classifer-Events') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'jobs')
                                        <a href="{{ url('/show-classifer-Jobs') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'services')
                                        <a href="{{ url('/show-classifer-Services') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'it-trainings')
                                        <a href="{{ url('/show-classifer-IT_Training') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'roomates-rentals')
                                        <a href="{{ url('/show-classifer-Roomates&Rental') }}/{{ $notification->indicate_id }}">   View </a>
                                        @elseif($notification->notification_indicate == 'signup')
                                        <a href="{{ url('/users') }}/{{ $notification->indicate_id }}"> View </a>
                                        @elseif($notification->notification_indicate == 'promote')
                                        <a href="{{ url('/product-ads') }}/{{ $notification->indicate_id }} /view"> View </a>
                                        @endif


                                    </button>

                                <form action="{{ route('notifications.toggleRead', $notification) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="mr-1 px-2 py-1 text-black {{ $notification->seen ? 'bg-green-500' : 'bg-red-500' }} rounded">
                                            {{ $notification->seen ? 'Mark Unread' : 'Mark Read' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                                onclick="return confirm('Are you sure you want to delete this notification?')">
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
