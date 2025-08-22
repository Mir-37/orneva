{{-- ✅ Newsletter --}}
<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up for newsletter</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>
    <div class="form">
        <form action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <input type="email" name="subscribed_email" placeholder="your email address" required>
            <button class="normal">Sign Up</button>
        </form>
    </div>
</section>
<footer class="section-p1">
    <div class="col">
        <img class="logo" src="img/logo.png" alt="">
        <h4>Contact</h4>
        <p><strong>Address:</strong> {{ $businessDetails['address'] ?? '' }}</p>
        <p><strong>Phone:</strong> {{ $businessDetails['phone'] ?? '' }}</p>
        <p><strong>Hours:</strong> {{ $businessDetails['hours'] ?? '' }}</p>
        <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <a href="{{ $businessDetails['facebook'] ?? '#' }}"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ $businessDetails['twitter'] ?? '#' }}"><i class="fa-brands fa-twitter"></i></a>
                <a href="{{ $businessDetails['instagram'] ?? '#' }}"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $businessDetails['youtube'] ?? '#' }}"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>About </h4>
        <a href="#">About us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
    </div>

    <div class="col">
        <h4>My Account </h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#">Help</a>
    </div>

    <div class="col install">
        <h4>Install App</h4>
        <p>From App Store or Google Play</p>
        <div class="row">
            <img src="img/pay/app.jpg" alt="">
            <img src="img/pay/play.jpg" alt="">
        </div>
        <p>Secured Payment Gateways</p>
        <img src="img/pay/pay.png" alt="">
    </div>
    <div class="copyright">
        <p>{{ $businessDetails['copyright'] ?? '' }}</p>
    </div>
</footer>
