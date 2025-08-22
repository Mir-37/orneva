@extends('layout.main')

@section('content')
    <section class="checkout-page py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Checkout Form -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="mb-4">Checkout</h3>

                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Delivery Address</label>
                                    <textarea class="form-control" id="address" name="delivery_address" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-select" name="payment_method" required>
                                        <option value="cod" selected>Cash on Delivery</option>
                                        <option value="bkash" disabled>bKash (coming soon)</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Place Order</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="summary p-4 shadow-sm bg-white rounded">
                        <h4 class="mb-3">Order Summary</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
