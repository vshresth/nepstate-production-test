@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Users Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('user.store') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>

        @php
           
            $usersByCountry = $users->groupBy('country_id');
        @endphp

       @foreach ($usersByCountry as $countryId => $countryUsers)
    @php
               $country = $countryUsers->first()->country ?? null;
        $countryName = $country ? $country->title : 'Unknown Country';
    @endphp

    <div class="intro-y mt-8">
        <h3 class="text-lg font-medium truncate mr-5">{{ $countryName }}</h3>
        <div class="intro-y overflow-auto lg:overflow-visible mt-4">
            <table class="table table-report">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="whitespace-nowrap">Email</th>
                        <th class="whitespace-nowrap">Account Type</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countryUsers as $user)
                        <tr class="intro-x">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->g_id == null)
                                    <span class="mr-1">Normal</span>
                                @else
                                    <span class="mr-1">Google</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->status == 1)
                                    <span class="mr-1">Active</span>
                                @else
                                    <span class="mr-1">Disabled</span>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('user.show', $user->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <a class="flex items-center mr-3" href="{{ route('user.edit', $user->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                    <form action="{{ route('users.user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                                onclick="return confirm('Are you sure you want to delete user ? \nPlease note that by proceeding with this action, all associated data including products, advertisements, blogs, confessions, forum posts, related comments, views, conversions, chats, and wishlist will be permanently removed.')">
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
@endforeach



    </div>
@endsection