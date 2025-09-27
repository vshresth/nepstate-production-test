@extends('layouts.app')

@section('title')
    Product Advertisement
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Product Advertisement Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('ad_create') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        {{-- <th class="whitespace-nowrap">By</th> --}}
                        <th class="whitespace-nowrap">Advertisement For</th>
                        {{-- <th class="whitespace-nowrap">Location</th> --}}
                        {{-- <th class="whitespace-nowrap">Status</th> --}}
                        <th class="whitespace-nowrap">Posted Date</th>
                        <th class="whitespace-nowrap">Expiry</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                        <tr class="intro-x">
                            {{-- <td>
                                @php
                                $user = $users->firstWhere('id', $ad->user_id);
                                @endphp
                                @if ($user)
                                    {{ $user->name }}
                                @else
                                    User not found
                                @endif
                            </td> --}}
                            {{-- <td> <img src="{{ $ad->image }}" alt="Advertisement Image" style="max-width: 200px;"></td> --}}

                            <td>{{ str_replace(['_', '-'], ' ', $ad->ad_for) }}</td>
                            {{-- <td>{{ $ad->ad_location }}</td> --}}

                            {{-- <td>
                                @if ($ad->status == 1)
                                    Active
                                @elseif ($ad->status == 2)
                                    Not Active
                                @else
                                    Unknown Status
                                @endif
                            </td> --}}
                            <td>{{ $ad->created_at }}</td>
                            <td>{{ $ad->ad_expires }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('ad_edit', ['id' => $ad->id]) }}" class="flex items-center mr-3"><i
                                            class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit</a>
                                    <a href="{{ route('ad_view', ['id' => $ad->id]) }}" class="flex items-center mr-3">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <form action="{{ route('ad_destroy', $ad->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
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
