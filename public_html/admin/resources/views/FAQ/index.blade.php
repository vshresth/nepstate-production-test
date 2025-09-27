@extends('layouts.app')

@section('title')
    FAQ
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                FAQs Table
            </h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('faqs.create') }}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i class="hidden sm:block w-4 h-4 mr-2" data-lucide="file-text"></i> Add New
                </a>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Question</th>
                        <th class="whitespace-nowrap">Answer</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr class="intro-x">
                            <td>{{ $faq->title }}</td>
                            <td>{{ Str::words(strip_tags($faq->description), 40, '...') }}</td>
                            <td>
                                @if ($faq->status == 1)
                                    Active
                                @elseif ($faq->status == 2)
                                Disabled
                                @else
                                    Unknown Status
                                @endif
                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    {{-- <a class="flex items-center mr-3" href="{{ route('faq.show', $faq->id) }}">
                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                            </a> --}}
                                    <a class="flex items-center mr-3" href="{{ route('faqs.edit', $faq->id) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                    </a>
                                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this FAQ?')">
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
