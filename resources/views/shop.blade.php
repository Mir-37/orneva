@extends('layout.main')
@section('content')

    {{-- Filters --}}
    <section class="py-4 bg-light">
        <div class="container">
            <form method="GET" action="{{ route('shop.index') }}" class="row g-3">
                <div class="col-md-6">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="brand" class="form-select" onchange="this.form.submit()">
                        <option value="">All Brands</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </section>

    {{-- Products --}}
    <section id="product1" class="py-5">
        <div class="container" class="pro-container">
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0" style="cursor:pointer;"
                            onclick="window.location.href='{{ route('product.show', $product->slug) }}'">
                            <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('frontend/img/products/f2.jpg') }}"
                                class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <span class="text-muted small">{{ $product->category->name ?? 'No Category' }}</span>
                                <h5 class="card-title mt-1">{{ $product->name }}</h5>
                                <div class="mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="{{ $i <= ($product->rating ?? 0) ? 'fa-solid' : 'fa-regular' }} fa-star text-warning"></i>
                                    @endfor
                                </div>
                                <h6 class="text-primary">${{ number_format($product->price, 2) }}</h6>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex justify-content-end">
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No products found.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
