document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('helloBtn');
    const msg = document.getElementById('message');
    if (btn) {
        btn.addEventListener('click', function() {
            msg.textContent = 'Hello, thanks for visiting!';
        });
    }

    let cartCount = 0;
    const cartCountElem = document.getElementById('cart-count');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            cartCount++;
            cartCountElem.textContent = cartCount;
            btn.textContent = 'Added!';
            btn.disabled = true;
            setTimeout(() => {
                btn.textContent = 'Add to Cart';
                btn.disabled = false;
            }, 1200);
        });
    });
});
