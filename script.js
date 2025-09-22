document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('helloBtn');
    const msg = document.getElementById('message');
    if (btn) {
        btn.addEventListener('click', function() {
            msg.textContent = 'Hello, thanks for visiting!';
        });
    }
});
