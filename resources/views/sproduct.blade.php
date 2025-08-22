@extends('layout.main')
@section('content')
    {{-- Product Details --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                {{-- Product Image --}}
                <div class="col-md-6">
                    <div class="border rounded shadow-sm p-3">
                        <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('frontend/img/products/f1.jpg') }}"
                            class="img-fluid w-100" alt="{{ $product->name }}">
                    </div>
                </div>

                {{-- Product Info --}}
                <div class="col-md-6">
                    <h2 class="fw-bold">{{ $product->name }}</h2>
                    <p class="text-muted mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    <span class="text-muted mb-2">{{ $product->brand->name ?? '' }}</span>

                    {{-- Rating --}}
                    <div class="mb-3 mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="{{ $i <= ($product->rating ?? 0) ? 'fa-solid' : 'fa-regular' }} fa-star text-warning"></i>
                        @endfor
                        {{-- <span class="small text-muted">({{ $product->reviews_count ?? 0 }} reviews)</span> --}}
                    </div>

                    {{-- Price --}}
                    <h4 class="text-primary mb-3">${{ number_format($product->price, 2) }}</h4>

                    <span class="small text-muted">In Stock: {{ $product->stock ?? 0 }}</span>

                    {{-- Description --}}
                    <p class="mb-4">{{ $product->description ?? 'No description available.' }}</p>

                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.add', $product->id) }}" method="POST"
                        class="d-flex align-items-center gap-3">
                        @csrf

                        Quantity: <input type="number" name="quantity" value="1" min="1"
                            class="form-control w-25" required max="{{ $product->stock }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping me-1"></i> Add to Cart
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    {{-- Related Products --}}
    <section class="py-5 bg-light">
        <div class="container">
            <h3 class="mb-4 text-center">Related Products</h3>
            <div class="row g-4">
                @forelse($related as $item)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0" style="cursor:pointer;"
                            onclick="window.location.href='{{ route('product.show', $item->slug) }}'">
                            <img src="{{ $item->image ? asset('storage/products/' . $item->image) : asset('frontend/img/products/f2.jpg') }}"
                                class="card-img-top" alt="{{ $item->name }}">
                            <div class="card-body">
                                <h6 class="fw-bold">{{ $item->name }}</h6>
                                <p class="text-primary mb-0">${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">No related products found.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
