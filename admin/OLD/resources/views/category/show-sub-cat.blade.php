@extends('layouts.app')

@section('title')
    Show Sub Category
@endsection

@section('content')
    <br>
    <form action="{{ route('category.storeSubCategory') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Add Sub Category for <span class="text-orange-500 text-2xl"
                            style="color: #ff9902">{{ $parentCategory->title }}</span>
                    </h2>


                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                        <a href="{{ route('category.index') }}" class="text-primary hover:text-primary-dark ml-auto">Return
                            Back</a>
                    </div>
                </div>
                <div id="input" class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <div class="form-group">
                                <label for="text_lorum">Text</label>
                                <textarea name="text_lorum" id="text_lorum" class="form-control"></textarea>
                                @error('text_lorum')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <script>
                                CKEDITOR.replace('text_lorum');
                            </script>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success text-white mt-5">Add</button>
                    <input type="hidden" name="parent_id" value="{{ $id }}">
                </div>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Sub Categories Table
                </h2>
                <div class="ml-auto">
                    <select id="startAlphabetSelect" class="form-select w-24">
                        <option value="">Sort By</option>
                        @foreach (range('a', 'z') as $letter)
                            <option value="{{ $letter }}">{{ strtoupper($letter) }}</option>
                        @endforeach
                    </select>
                    <button id="sortAlphabeticallyButton" class="btn btn-primary mr-2">Sort Alphabetically</button>

                </div>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table id="subcategories-table" class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Title</th>
                            <th class="whitespace-nowrap">Text</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="intro-x" data-category-id="{{ $category->id }}">
                                <td>{{ $category->title }}</td>
                                <td>{{ strip_tags($category->text_lorum) }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="btn flex items-center mr-3"
                                            href="{{ route('category.editSubCategory', $category->id) }}">
                                            <i class="w-4 h-4 mr-1" data-lucide="check-square"></i> Edit
                                        </a>
                                        <form action="{{ route('category.destroySubCategory', $category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn flex items-center text-danger"
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
    </div>

    <script>
        function sortTableAlphabetically() {
            const table = document.getElementById('subcategories-table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const titleA = a.querySelector('td:first-child').innerText.toLowerCase();
                const titleB = b.querySelector('td:first-child').innerText.toLowerCase();
                return titleA.localeCompare(titleB);
            });

            rows.forEach(row => tbody.appendChild(row));
        }

        function sortTableByStartAlphabet(startAlphabet) {
            const table = document.getElementById('subcategories-table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const titleA = a.querySelector('td:first-child').innerText.toLowerCase();
                const titleB = b.querySelector('td:first-child').innerText.toLowerCase();
                const startsWithA = titleA.startsWith(startAlphabet);
                const startsWithB = titleB.startsWith(startAlphabet);

                if (startsWithA && !startsWithB) {
                    return -1;
                } else if (!startsWithA && startsWithB) {
                    return 1;
                } else {
                    return titleA.localeCompare(titleB);
                }
            });

            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
        }

        document.getElementById('sortAlphabeticallyButton').addEventListener('click', function() {
            sortTableAlphabetically();
        });

        document.getElementById('startAlphabetSelect').addEventListener('change', function() {
            const startAlphabet = this.value.toLowerCase();
            if (startAlphabet) {
                sortTableByStartAlphabet(startAlphabet);
            }
        });
    </script>
@endsection
