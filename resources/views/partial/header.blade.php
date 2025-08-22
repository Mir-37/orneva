{{-- Header --}}
<section id="header">
    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/logo.png') }}" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a class="active" href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping"></i></a></li>

            {{-- User Icon --}}
            @auth
                {{-- Check if a customer is logged in --}}
                <li>
                    <a href="{{ route('filament.customer.pages.dashboard') }}">
                        <i class="fa-solid fa-user"></i> {{ auth()->user()->name }}
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('filament.customer.auth.register') }}">
                        <i class="fa-solid fa-user"></i> Login / Register
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</section>
