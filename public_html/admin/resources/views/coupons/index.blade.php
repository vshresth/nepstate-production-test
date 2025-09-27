@extends('layouts.app')

@section('title')
    Coupons
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Coupons
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('coupons.create') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Coupon Code</th>
                        <th class="whitespace-nowrap">Discount</th>
                        <th class="whitespace-nowrap">Discount Type</th>
                        <th class="whitespace-nowrap">Category</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="whitespace-nowrap">Start Date</th>
                        <th class="whitespace-nowrap">End Date</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr class="intro-x">
                            <td>
                                <span onclick="copyToClipboard('{{ $coupon->coupon_code }}')"
                                    style="cursor: pointer; color: rgb(255, 0, 0);">
                                    {{ $coupon->coupon_code }}
                                </span>
                            </td>
                            <td>{{ $coupon->discount }}</td>
                            <td>
                                @if ($coupon->discount_type == 1)
                                    <span class="mr-1">Flat</span>
                                @elseif($coupon->discount_type == 0)
                                    <span class="mr-1">Percent</span>
                                @endif
                            </td>
                                <td>
                                    @if($coupon->category_id == 0) 
                                        <span class="mr-1" style="color:green;">Sitewide Discount</span>
                                    @else
                                        <span class="mr-1">{{ $coupon->category->title ?? '' }}</span>
                                    @endif
                                </td>
                            <td>
                                @if ($coupon->end_date > date('Y-m-d') && $coupon->start_date <= date('Y-m-d'))
                                    <span class="mr-1" style="color:green;">Active</span>
                                @elseif($coupon->end_date <= date('Y-m-d'))
                                    <span class="mr-1" style="color:red;">Expired</span>
                                @elseif($coupon->start_date > date('Y-m-d'))
                                    <span class="mr-1" style="color:skyblue;">Upcoming</span>

                                @endif
                                
                            </td>
                            <td>
                                {{ $coupon->start_date }}
                            </td>
                            <td>
                                {{ $coupon->end_date }}
                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('coupons.edit', $coupon->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this coupon?')">
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
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Coupon code copied to clipboard: ' + text);
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endsection
