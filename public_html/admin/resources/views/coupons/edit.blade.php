@extends('layouts.app')

@section('title')
    Edit Coupon
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Edit Coupon
            </h2>
        </div>
        <div class="intro-y box p-5 mt-5">
            <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="coupon_code" class="form-label">Coupon Code</label>
                    @error('coupon_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="flex">
                        <input type="text" id="coupon_code" name="coupon_code" class="form-control"
                            value="{{ $coupon->coupon_code }}" required>
                        <button type="button" onclick="generateCouponCode()" class="btn btn-secondary ml-2">Generate
                        </button>

                    </div>
                    {{-- <div>
                    <label for="coupon_code" class="form-label">Coupon Code</label>
                    <div class="flex">
                        <input type="text" id="coupon_code" name="coupon_code" class="form-control" required>
                        <button type="button" onclick="generateCouponCode()" class="btn btn-secondary ml-2">Generate</button>
                    </div>
                </div> --}}
                    <div class="mt-3">
                        <label for="discount" class="form-label">Discount</label>
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="number" id="discount" name="discount" class="form-control"
                            value="{{ $coupon->discount }}" required>

                    </div>
                    <div class="mt-3">
                        <label for="discount_type" class="form-label">Discount Type</label>
                        @error('discount_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id="discount_type" name="discount_type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="1" {{ $coupon->discount_type == 1 ? 'selected' : '' }}>Flat</option>
                            <option value="0" {{ $coupon->discount_type == 0 ? 'selected' : '' }}>Percent</option>
                        </select>

                    </div>

                    <div class="mt-3">
                    <label for="discount_type" class="form-label">Categories</label>
                    <select id="discount_type" name="category_id" class="form-control" required>
                        <option value="0" {{ $coupon->category_id == 0 ? 'selected' : '' }}>Sitewide Discount</option>
                        @foreach ($getCategories as $category)
                            <option value="{{ $category->id }}" {{ $coupon->category_id == $category->id ? 'selected' : '' }} >{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>


                    {{-- <div class="mt-3">
                        <label for="status" class="form-label">Status</label>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id="status" name="status" class="form-control" required>
                            <option value="">Select Option</option>
                            <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>

                    </div> --}}

                    <div class="mt-3">
                    <label for="status" class="form-label">Start date</label>
                    <input type="date" id="start_date" name="start_date" value="{{  $coupon->start_date}}" class="form-control" min="{{ date('Y-m-d') }}">
                </div>

                <div class="mt-3">
                    <label for="status" class="form-label">End date</label>
                    <input type="date" id="end_date" name="end_date" value="{{  $coupon->end_date}}"  class="form-control" min="{{ $coupon->start_date }}">
                </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                        <a href="{{ route('coupons.index') }}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>

            </form>
        </div>
    </div>
    <script>
        function generateCouponCode() {
            const length = 15;
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let couponCode = '';
            for (let i = 0; i < length; i++) {
                couponCode += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('coupon_code').value = couponCode;
        }
    </script>
    <script>
        function generateCouponCode() {
            const length = 15;
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let couponCode = '';
            for (let i = 0; i < length; i++) {
                couponCode += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('coupon_code').value = couponCode;
        }
    </script>
     <script>
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        startDateInput.addEventListener('change', function () {
            const startDateValue = this.value;
           
            if (startDateValue) {
                endDateInput.min = startDateValue;
                endDateInput.disabled = false; 
            } else {
                endDateInput.min = '';
                endDateInput.disabled = true; 
            }
        });

        // endDateInput.disabled = true;
    </script>
@endsection
