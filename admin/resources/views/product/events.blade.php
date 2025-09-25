
@extends('layouts.app')

@section('title')
    Events
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                {{ get_category_title('events') }} Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <form method="GET" action="{{ route('events') }}" class="flex items-center">
                    <select id="country_id" name="country_id" class="form-select mr-3">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ $selectedCountryId == $country->id ? 'selected' : '' }}>
                                {{ $country->title }}
                            </option>
                        @endforeach
                    </select>
                    <select id="status" name="status" class="form-select mr-3">
                        <option value="" >-- Select Status --</option>
                        <option <?php echo $status == 'active' ? 'selected' : '' ?>  value="active" style="color:green;"> Active </option>
                        <option <?php echo $status == 'expired' ? 'selected' : '' ?> value="expired" style="color:red;"> Expired </option>
                    </select>
                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Display events based on selected country -->
    <div class="intro-y mt-8">
        <div class="intro-y overflow-auto lg:overflow-visible mt-4">
            <table class="table table-report">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Title</th>
<th class="whitespace-nowrap">Country</th>
                        <th class="whitespace-nowrap">Category</th>
                        <th class="whitespace-nowrap">Sub Category</th>
                        <th class="whitespace-nowrap">Slug</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        @php
                            $countryName = $countries->firstWhere('id', $event->country_id)->title ?? 'Unknown Country';
                        @endphp
                        <tr class="intro-x">
                            <td>{{ $event->title }}</td>
<td>{{ $countryName }}</td>
                            <td>{{ $event->category }}</td>
                            <td>{{ $event->sub_cat }}</td>
                            <td>{{ $event->slug }}</td>
                            <td>
                                @if($event->expiry_date > date('Y-m-d'))
                                    <span class="text-success">Active</span>
                                @elseif($event->expiry_date <= date('Y-m-d'))
                                    <span class="text-danger">Expired</span>
                                @endif
                            </td>
                            
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('events.show', $event->id) }}?country_id={{ $selectedCountryId }}&status={{ $status }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <form action="{{ route('destroy.Classified', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No events available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
