@extends('layouts.app')

@section('title')
    User Information
@endsection

@section('content')
    <div class="intro-y  mt-5">
        <div class="grid col-span-4 gap-3 lg:col-span-4 2xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div
                    class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate flex items-center">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                        User Info
                    </div>
                    <a href="{{ url('/users') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
                </div>

                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="User Profile" class="rounded-full" src="{{ $users->profile_pic }}">
                            </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                                    {{ $users->name }}
                                </div>
                                <div class="text-slate-500">{{ $users->username }}</div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="flex flex-col justify-center items-end lg:items-end mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center justify-end">{{ $users->email }}
                                    <i data-lucide="mail" class="w-4 h-4 mr-2" style="margin-left: 10px"></i>
                                </div>
                                <div class="truncate sm:whitespace-normal flex items-center justify-end">
                                    {{ $country->title ?? 'Country Does Not Exist' }}
                                    <i data-lucide="globe" class="w-4 h-4 mr-2" style="margin-left: 10px"></i>
                                </div>
                                {{-- <div class="truncate sm:whitespace-normal flex items-center justify-end mt-3">
                                    {{ $users->phone }} <i data-lucide="phone" class="w-4 h-4 mr-2"
                                        style="margin-left: 10px"></i>
                                </div> --}}
                                {{-- <div class="truncate sm:whitespace-normal flex items-center justify-end mt-3">
                                    {{ $users->address }} <i data-lucide="home" class="w-4 h-4 mr-2"
                                        style="margin-left: 10px"></i>
                                </div> --}}
                                <div class="truncate sm:whitespace-normal flex items-center justify-end mt-3">
                                    @if ($users->status == 1)
                                        <span class="flex items-center bg-success/20 text-success rounded px-2 ml-2">
                                            <span class="mr-1">Active</span>
                                            <i data-loading-icon="puff" data-color="white" class="w-4 h-4"></i>
                                        </span>
                                    @elseif($users->status == 2)
                                        <span class="flex items-center bg-danger/20 text-danger rounded px-2 ml-2">
                                            <span class="mr-1">Disabled</span>
                                            <i data-loading-icon="three-dots" data-color="1a202c" class="w-4 h-4"></i>
                                        </span>
                                    @endif
                                    <i data-lucide="shield" class="w-4 h-4 text-slate-500 mr-2"
                                        style="margin-left: 10px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-span-12 mt-6" style="box-shadow: 0px 0px 20px rgba(107, 107, 107, 0.1); border-radius: 8px;">
        <div class="intro-y block sm:flex items-center h-10"
            style="padding-top:2% ;justify-content: center; font-size:xx-large">
            <h2 style="font-size: xx-large; font-weight: bold;">
                Users Blogs
            </h2>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0" style="padding-left: 1%; padding-right: 1%; ">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Image</th>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Slug</th>
                        <th class="whitespace-nowrap">Tags</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr class="intro-x">
                            <td>
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img src="{{ $blog->image }}" alt="Image">
                                </div>
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td>
                                @php
                                    $tags = explode(',', $blog->tags);
                                @endphp
                                @foreach ($tags as $tag)
                                    <span class="badge badge-primary px-2 mr-1">{{ $tag }}</span>
                                @endforeach
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('blogs.show', ['id' => $blog->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>

                                    <form action="{{ route('blogs.destroy', ['id' => $blog->id]) }}" method="POST">
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
    <br>
    <div class="col-span-12 mt-6" style="box-shadow: 0px 0px 20px rgba(107, 107, 107, 0.1);border-radius: 8px;">
        <div class="intro-y block sm:flex items-center h-10"
            style="padding-top:2% ;justify-content: center; font-size:xx-large">
            <h2 style="font-size: xx-large; font-weight: bold;">
                Users Confessions
            </h2>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0" style="padding-left: 1%; padding-right: 1%;">

            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Slug</th>
<th class="whitespace-nowrap">Tags</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($confessions as $confession)
                        <tr class="intro-x">
                                                        <td>{{ $confession->title }}</td>
                            <td>{{ $confession->slug }}</td>
<td>
                                @php
                                    $tags = explode(',', $confession->tags);
                                @endphp
                                @foreach ($tags as $tag)
                                    <span class="badge badge-primary px-2 mr-1">{{ $tag }}</span>
                                @endforeach
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('confessions.show', ['id' => $confession->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>

                                    <form action="{{ route('confessions.destroy', ['id' => $confession->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this confession?')">
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
    <br>
    <div class="col-span-12 mt-6" style="box-shadow: 0px 0px 20px rgba(107, 107, 107, 0.1);border-radius: 8px;">
        <div class="intro-y block sm:flex items-center h-10"
            style="padding-top:2% ;justify-content: center; font-size:xx-large">
            <h2 style="font-size: xx-large; font-weight: bold;">
                Users Forums
            </h2>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0" style="padding-left: 1%; padding-right: 1%;">

            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                      <th class="whitespace-nowrap">Image</th>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Slug</th>
<th class="whitespace-nowrap">Tags</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forums as $confession)
                        <tr class="intro-x">
                            <td>
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img src="{{ $confession->image }}" alt="Image">
                                </div>
                            </td>
                            <td>{{ $confession->title }}</td>
                            <td>{{ $confession->slug }}</td>
<td>
                                @php
                                    $tags = explode(',', $confession->tags);
                                @endphp
                                @foreach ($tags as $tag)
                                    <span class="badge badge-primary px-2 mr-1">{{ $tag }}</span>
                                @endforeach
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('forums.show', ['id' => $confession->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>

                                    <form action="{{ route('forums.destroy', ['id' => $confession->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this confession?')">
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
    <br>
    <div class="col-span-12 mt-6" style="box-shadow: 0px 0px 20px rgba(107, 107, 107, 0.1);border-radius: 8px;">
        <div class="intro-y block sm:flex items-center h-10"
            style="padding-top:2% ;justify-content: center; font-size:xx-large">
            <h2 style="font-size: xx-large; font-weight: bold;">
                Users Classified
            </h2>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0" style="padding-left: 1%; padding-right: 1%;">

            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Category</th>
                        <th class="whitespace-nowrap">Slug</th>
                        <th class="whitespace-nowrap">Sub Category</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $product)
                        <tr class="intro-x">

                            <td>{{ $product->title }}</td>


                            <td>{{ $product->category }}</td>
                            <td>{{ $product->sub_cat }}</td>

                            <td>{{ $product->slug }}</td>


                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('events.show', ['id' => $product->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>
                                    <form action="{{ route('destroy.Classified', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this list?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($jobs as $product)
                        <tr class="intro-x">

                            <td>{{ $product->title }}</td>


                            <td>{{ $product->category }}</td>
                            <td>{{ $product->sub_cat }}</td>

                            <td>{{ $product->slug }}</td>


                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('job.show', ['id' => $product->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>

                                    <form action="{{ route('destroy.Classified', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this list?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($services as $product)
                        <tr class="intro-x">

                            <td>{{ $product->title }}</td>


                            <td>{{ $product->category }}</td>
                            <td>{{ $product->sub_cat }}</td>

                            <td>{{ $product->slug }}</td>


                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('service.show', ['id' => $product->id]) }}">
                                        <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                    </a>

                                    <form action="{{ route('destroy.Classified', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn flex items-center text-danger"
                                            onclick="return confirm('Are you sure you want to delete this list?')">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach @foreach ($rooms as $product)
                            <tr class="intro-x">

                                <td>{{ $product->title }}</td>


                                <td>{{ $product->category }}</td>
                                <td>{{ $product->sub_cat }}</td>

                                <td>{{ $product->slug }}</td>


                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                            href="{{ route('rental.show', ['id' => $product->id]) }}">
                                            <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                        </a>

                                        <form action="{{ route('destroy.Classified', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn flex items-center text-danger"
                                                onclick="return confirm('Are you sure you want to delete this list?')">
                                                <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @endforeach @foreach ($trains as $product)
                                <tr class="intro-x">

                                    <td>{{ $product->title }}</td>


                                    <td> {{ $product->category }}</td>
                                    <td>{{ $product->sub_cat }}</td>

                                    <td>{{ $product->slug }}</td>


                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a class="flex items-center mr-3"
                                                href="{{ route('train.show', ['id' => $product->id]) }}">
                                                <i class="w-4 h-4 mr-1" data-lucide="eye"></i> View
                                            </a>

                                            <form action="{{ route('destroy.Classified', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn flex items-center text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this list?')">
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
    <div class="col-span-12 mt-6" style="box-shadow: 0px 0px 20px rgba(107, 107, 107, 0.1);border-radius: 8px;">
        <div class="intro-y block sm:flex items-center h-10"
            style="padding-top:2% ;justify-content: center; font-size:xx-large">
            <h2 style="font-size: xx-large; font-weight: bold;">
                Users Advertisement
            </h2>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0" style="padding-left: 1%; padding-right: 1%;">

            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        {{-- <th class="whitespace-nowrap">Image</th> --}}
                        <th class="whitespace-nowrap">Advertisement For</th>
                        <th class="whitespace-nowrap">Category</th>
                        <th class="whitespace-nowrap">Posted Date</th>
                        <th class="whitespace-nowrap">Expiry</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                        <tr class="intro-x">
                            {{-- <td>
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img src="{{ asset($ad->image) }}" alt="Image">
                                </div>
                            </td> --}}
                            <td>{{ str_replace(['_', '-'], ' ', $ad->ad_for) }}</td>
                            </td>
                            <td>{{ strtoupper(str_replace(['-', '_'], ' ', $ad->category)) }}</td>
                            <td>{{ $ad->created_at }}</td>
                            <td>{{ $ad->ad_expires }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
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
