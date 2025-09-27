@extends('layouts.app')

@section('title')
    IT Training
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                IT Training Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <form method="GET" action="{{ route('trainings') }}" class="flex items-center">
                    <select id="country_id" name="country_id" class="form-select mr-3">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ $selectedCountryId == $country->id ? 'selected' : '' }}>
                                {{ $country->title }}
                            </option>
                        @endforeach
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
                                                <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainings as $training)
                        @php
                            $countryName = $countries->firstWhere('id', $training->country_id)->title ?? 'Unknown Country';
                        @endphp
                        <tr class="intro-x">
                            <td>{{ $training->title }}</td>
<td>{{ $countryName }}</td>
                            <td>{{ $training->category }}</td>
                            <td>{{ $training->sub_cat }}</td>
                            <td>{{ $training->slug }}</td>
                            
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('train.show', $training->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <form action="{{ route('destroy.Classified', $training->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger" onclick="return confirm('Are you sure you want to delete this IT Training?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No IT Training available for the selected country.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
