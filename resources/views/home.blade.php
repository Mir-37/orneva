@extends('layout.main')
@section('content')
    <base href="{{ url('/frontend/') }}/">

    {{--  Hero Section --}}
    <section id="hero">
        <h4>Limited Editions</h4>
        <h2>Wear Simplicity</h2>
        <h1>Flaunt Art</h1>
        <p>Crafted with Love</p>
        <a href="{{ route('shop.index') }}" class="button">
            <span class="button_lg">
                <span class="button_sl"></span>
                <span class="button_text">Shop Now</span>
            </span>
        </a>
    </section>

    {{-- Features --}}
    <section id="feature" class="section-p1">

        <div class="fe-box">
            <img src="img/features/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="">
            <h6 style="background-color: #8338ec;">Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="">
            <h6 style="background-color: #ef233c;">Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="">
            <h6 style="background-color: #f28f3b;">Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="">
            <h6 style="background-color: #a5be00;">Communication</h6>
        </div>


    </section>

    {{--  Featured Products --}}
    <section id="product1" class="section-p1">
        <h1 style="color: white;">Featured Products</h1>
        <h3 style="color: white;">Embrace the fashion</h3>
        <div class="pro-container">
            @foreach ($featuredProducts as $product)
                <div class="pro">
                    <img src="{{ $product->image ? 'products/' . $product->image : 'img/products/f3.jpg' }}" alt="">
                    <div class="des">
                        <span>{{ $product->category->name ?? 'No Category' }}</span>
                        <h5>{{ $product->name }}</h5>
                        <div class="star">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= ($product->rating ?? 0) ? '' : '-o' }}"></i>
                            @endfor
                        </div>
                        <h4>${{ number_format($product->price, 2) }}</h4>
                    </div>
                    <a href="{{ route('cart.add', $product->id) }}"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            @endforeach
        </div>
    </section>

    {{--  Banner --}}
    <section id="banner" class="section-m1">
        <h4>Explore More Of Us</h4>
        <h2>Up to 30% off - all shirts and t-shirts</h2>
        <a href="{{ route('shop.index') }}"><button>Explore More</button></a>
    </section>


    {{--  New Arrivals --}}
    <section id="product1" class="section-p1">
        <h1 style="color: white;">New Arrivals</h1>
        <h3 style="color: white;">Embrace the fashion</h3>
        <div class="pro-container">
            @foreach ($newArrivals as $product)
                <div class="pro">
                    <img src="{{ $product->image ? 'products/' . $product->image : 'img/products/f1.jpg' }}" alt="">
                    <div class="des">
                        <span>{{ $product->category->name ?? 'No category' }}</span>
                        <h5>{{ $product->name }}</h5>
                        <div class="star">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= ($product->rating ?? 0) ? '' : '-o' }}"></i>
                            @endfor
                        </div>
                        <h4>${{ number_format($product->price, 2) }}</h4>
                    </div>
                    <a href="{{ route('cart.add', $product->id) }}"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            @endforeach
        </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Great Deals</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>Find Your Fit On ORNEVA</span>
        </div>

        <div class="banner-box banner-box2">
            <h4>Great Deals</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>Find Your Fit On ORNEVA</span>
        </div>

    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring/Summer 2022</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>T shirts</h2>
            <h3>New Trends</h3>
        </div>
    </section>
@endsection
