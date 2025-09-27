@extends('layouts.app')

@section('title')
    Reviews Page
@endsection

@section('content')
    @if (Session::has('success'))
        <br>
        <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert">
            <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> 
            {{ Session::get('success') }} 
            <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="lock"> 
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <br>
    @endif
    <div class="intro-y news xl:w-3/5 p-5 box mt-8" style="background-color: #f3f4f6;">

        <div class="col-span-12 mt-2">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                   All Reviews
                </h2>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">User Name</th>
                            <th class="whitespace-nowrap">Product Title</th>
                            <th class="whitespace-nowrap">Review Title</th>
                            <th class="whitespace-nowrap">Rating</th>
                            <th class="whitespace-nowrap">Review</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderReviews as $review)
                            <tr class="intro-x">
                                <td style="width: 7%">{{ $review->user_name }}</td>
                                <td style="width: 7%">{{ $review->product_title }}</td>
                                <td style="width: 25%">{{ $review->title }}</td>
                                <td style="width: 7%">{{ $review->rating }}</td>
                                <td style="width: 54%">
                                    @php
                                    $reviewContent = $review->review ?? 'No Review Available';
        $reviewLines = explode("\n", $reviewContent); 
        echo implode("<br>", array_slice($reviewLines, 0, 5)); 
    @endphp
</td>

<td class="table-report__action w-56">
    <div class="flex justify-center items-center">
        <form action="{{ route('delete.order.review', ['id' => $review->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning btn-sm"
                onclick="return confirm('Are you sure you want to delete this review?')">
                <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete Review
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
    </div>
    <br>
@endsection
