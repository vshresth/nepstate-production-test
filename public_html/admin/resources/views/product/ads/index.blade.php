@extends('layouts.app')

@section('title')
    Product Advertisement
@endsection

@section('content')
<?php 
    $adTitle = '';
                        $request = request();
                        if($request->type == 'active') {
                            $adTitle = "Active Ads";
                        }else if($request->type == 'expired'){
                            $adTitle = "Expired Ads";
                        }
                    ?>
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Product Advertisement Table {{$country->title}} ({{$adTitle}})
            </h2>
            <a href="{{ url('/countryAdvertisment') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
            <!-- <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('ad_create') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div> -->
        </div>
            <br><br>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <h1 class="text-lg font-medium truncate mr-5">
                    

                </h1>
       
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        {{-- <th class="whitespace-nowrap">By</th> --}}
                        <th class="whitespace-nowrap">Advertisement For</th>
                        {{-- <th class="whitespace-nowrap">Lgocation</th> --}}
                        {{-- <th class="whitespace-nowrap">Status</th> --}}
                        <th class="whitespace-nowrap">Posted Date</th>
                        <th class="whitespace-nowrap">Ad Expires (Days)</th>

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
                            <td>
                            @php
                                    $futureDate = \Carbon\Carbon::parse($ad->ad_expires);
                                    $now = \Carbon\Carbon::now();
                                @endphp

                                @if ($futureDate->isFuture())
                                    <p>Days left: {{ $now->diffInDays($futureDate) }}</p>
                                @elseif ($futureDate->isPast())
                                    <p style="color:red;">Ad has expired</p>
                            @endif

                            </td>
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
