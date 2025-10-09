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
        
        <!-- Include SortableJS for drag and drop -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        
        <!-- CSS for drag and drop styling -->
        <style>
        .sortable-ghost {
            opacity: 0.4;
            background: #f3f4f6;
        }
        .sortable-chosen {
            background: #dbeafe;
            border: 2px solid #3b82f6;
        }
        .sortable-drag {
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: rotate(5deg);
        }
        .sortable-fallback {
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .drag-handle:hover {
            background-color: #e5e7eb !important;
            border-color: #9ca3af !important;
        }
        </style>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Order</th>
                        <th class="whitespace-nowrap">Title</th>
                        <th class="whitespace-nowrap">Months</th>
                        <th class="whitespace-nowrap">Price</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody id="sortable-payment-plans">
                    @foreach ($payments as $index => $payment)
                        <tr class="intro-x sortable-row" data-id="{{ $payment->id }}" data-sort-order="{{ $payment->sort_order ?? $index + 1 }}">
                            <td class="text-center">
                                <div class="flex items-center justify-center">
                                    <div class="drag-handle text-gray-400 hover:text-gray-600 cursor-move bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded border-2 border-dashed border-gray-300 hover:border-gray-400 transition-all">
                                        <span class="text-lg font-bold">⋮⋮</span>
                                        <div class="text-xs text-gray-500">Drag</div>
                                    </div>
                                    <span class="text-xs text-gray-500 bg-blue-100 px-2 py-1 rounded ml-3 font-bold">
                                        {{ $payment->sort_order ?? $index + 1 }}
                                    </span>
                                    <div class="flex flex-col ml-2">
                                        @if($index > 0)
                                            <form action="{{ route('payment.moveUp', $payment->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs" title="Move Up">↑</button>
                                            </form>
                                        @endif
                                        @if($index < count($payments) - 1)
                                            <form action="{{ route('payment.moveDown', $payment->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs" title="Move Down">↓</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
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
                                    @if($payment->is_free_plan == 0)
                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this payment plan?');">
                                        @csrf
                                        @method('DELETE')
                                       <button type="submit" class="flex items-center text-danger">
                                            <i class="w-4 h-4 mr-1" data-lucide="trash-2"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
    let sortableInstance = null;
    
    function initializeSortable() {
        // Destroy existing instance if it exists
        if (sortableInstance) {
            sortableInstance.destroy();
        }
        
        // Initialize new SortableJS instance
        sortableInstance = Sortable.create(document.getElementById('sortable-payment-plans'), {
            handle: '.drag-handle',
            animation: 300,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            forceFallback: true,
            fallbackClass: 'sortable-fallback',
            onStart: function(evt) {
                evt.item.style.opacity = '0.5';
            },
            onEnd: function(evt) {
                evt.item.style.opacity = '1';
                
                // Get the new order
                const rows = document.querySelectorAll('.sortable-row');
                const newOrder = [];
                
                rows.forEach((row, index) => {
                    const id = row.getAttribute('data-id');
                    const newSortOrder = index + 1;
                    newOrder.push({id: id, sort_order: newSortOrder});
                    
                    // Update the sort order display
                    const sortOrderSpan = row.querySelector('.text-xs');
                    if (sortOrderSpan) {
                        sortOrderSpan.textContent = newSortOrder;
                    }
                    row.setAttribute('data-sort-order', newSortOrder);
                });
                
                // Send AJAX request to update the order
                updatePaymentPlanOrder(newOrder);
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        initializeSortable();
    });
    
    function updatePaymentPlanOrder(order) {
        // Show loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.innerHTML = '<div class="fixed top-4 right-4 bg-blue-500 text-white px-4 py-2 rounded shadow-lg z-50">Updating order...</div>';
        document.body.appendChild(loadingDiv);
        
        // Send AJAX request
        fetch('{{ route("payment.updateOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                              document.querySelector('input[name="_token"]')?.value || 
                              '{{ csrf_token() }}'
            },
            body: JSON.stringify({order: order})
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading indicator
            document.body.removeChild(loadingDiv);
            
            // Show success message
            const successDiv = document.createElement('div');
            successDiv.innerHTML = '<div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">Order updated successfully!</div>';
            document.body.appendChild(successDiv);
            
            // Reinitialize SortableJS to keep drag-and-drop working
            setTimeout(() => {
                console.log('Reinitializing SortableJS after successful update');
                initializeSortable();
            }, 100);
            
            // Remove success message after 3 seconds
            setTimeout(() => {
                if (document.body.contains(successDiv)) {
                    document.body.removeChild(successDiv);
                }
            }, 3000);
        })
        .catch(error => {
            // Remove loading indicator
            if (document.body.contains(loadingDiv)) {
                document.body.removeChild(loadingDiv);
            }
            
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.innerHTML = '<div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg z-50">Error updating order. Please try again.</div>';
            document.body.appendChild(errorDiv);
            
            // Remove error message after 5 seconds
            setTimeout(() => {
                if (document.body.contains(errorDiv)) {
                    document.body.removeChild(errorDiv);
                }
            }, 5000);
            
            console.error('Error:', error);
            // Reload page to reset order
            location.reload();
        });
    }
    </script>
@endsection
