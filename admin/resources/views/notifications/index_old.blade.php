@extends('layouts.app')

@section('title')
    Notifications
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        @if (Session::has('success'))
            <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i
                    data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('success') }} <button type="button"
                    class="btn-close" data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
        {{-- <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Users Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('user.store') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div> --}}
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Content</th>
                        <th class="whitespace-nowrap">Created At</th>
                        <th class="whitespace-nowrap">Message</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr class="intro-x">
                            <td style="width: 45%">{{ $notification->content }}</td>
                            <td style="width: 20%">{{ $notification->created_at }}</td>
                            <td style="width: 20%">
                                <form action="{{ route('notifications.toggleRead', $notification) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="mr-1 px-2 py-1 text-black {{ $notification->read ? 'bg-green-500' : 'bg-red-500' }} rounded">
                                        {{ $notification->read ? 'Read' : 'Unread' }}
                                    </button>
                                </form>
                            </td>
                            <td class="table-report__action w-15">
                                <div class="flex justify-center items-center">
                                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST">
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
