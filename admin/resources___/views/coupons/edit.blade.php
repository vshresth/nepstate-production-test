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
                        <label for="status" class="form-label">Status</label>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select id="status" name="status" class="form-control" required>
                            <option value="">Select Option</option>
                            <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>

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
@endsection
