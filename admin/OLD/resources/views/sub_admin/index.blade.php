@extends('layouts.app')

@section('title')
    Sub Admin
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Sub Admins
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('subadmin-create') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="whitespace-nowrap">Email</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subAdmins as $user)
                        <tr class="intro-x">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->status == 1)
                                    <span class="mr-1">Active</span>
                                @else
                                    <span class="mr-1">Disabled</span>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">

                                    <a class="flex items-center mr-3" href="{{ route('subadmin-edit', $user->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>

                                    <a href="{{ url('sub-admin-delete') }}/{{ $user->id }}" type="submit"
                                        class="flex items-center text-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
