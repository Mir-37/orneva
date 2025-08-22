// Highlight active navbar link
document.addEventListener('DOMContentLoaded', () => {
  const navbarLinks = document.querySelectorAll('#navbar li a');
  navbarLinks.forEach(link => {
    link.addEventListener('click', function() {
      navbarLinks.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
    });
  });
});

// Scroll-to-top button
const scrollBtn = document.createElement('button');
scrollBtn.textContent = '↑';
scrollBtn.style.position = 'fixed';
scrollBtn.style.bottom = '30px';
scrollBtn.style.right = '30px';
scrollBtn.style.display = 'none';
scrollBtn.style.background = '#7C5E57';
scrollBtn.style.color = '#F3E9E1';
scrollBtn.style.border = 'none';
scrollBtn.style.borderRadius = '50%';
scrollBtn.style.width = '40px';
scrollBtn.style.height = '40px';
scrollBtn.style.fontSize = '20px';
scrollBtn.style.cursor = 'pointer';
document.body.appendChild(scrollBtn);

window.addEventListener('scroll', () => {
  scrollBtn.style.display = window.scrollY > 200 ? 'block' : 'none';
});

scrollBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Newsletter form handler
const newsletterForm = document.querySelector('#newsletter .form form');
if (newsletterForm) {
  newsletterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const emailInput = this.querySelector('input[type="email"]');
    if (emailInput && emailInput.value) {
      alert('Thank you for subscribing!');
      emailInput.value = '';
    } else {
      alert('Please enter a valid email address.');
    }
  });
}

// Add to Cart functionality for product cards only
const cartButtons = document.querySelectorAll('.pro .fa-cart-shopping');
cartButtons.forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const productEl = this.closest('.pro');
    const product = {
      img: productEl.querySelector('img').src,
      brand: productEl.querySelector('.des span').textContent,
      name: productEl.querySelector('.des h5').textContent,
      price: productEl.querySelector('.des h4').textContent
    };
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));

    });
});