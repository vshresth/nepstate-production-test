@extends('layouts.app')

@section('title')
    Payment Plan
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Payment Plan
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{route('payment.create')}}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Months</th>
                        <th class="whitespace-nowrap">Price</th>

                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr class="intro-x">
                            <td>{{ $payment->title ?? 'null' }}</td>
                            <td>{{ $payment->months ?? 'null' }}</td>
                            <td>$ {{ $payment->amount ?? 'null' }}</td>
                            <td>
                                @if ($payment->status == 1)
                                    <span class="mr-1">Active</span>
                                @elseif ($payment->status == 0)
                                    <span class="mr-1">Disabled</span>
                                @else
                                    <span class="mr-1">null</span>
                                @endif
                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('payment.edit', $payment->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this payment plan?');">
                                        @csrf
                                        @method('DELETE')
                                       <button type="submit" class="flex items-center text-danger">
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
