document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Clear previous errors
            form.querySelectorAll('.error-text').forEach(el => el.remove());

            // Collect password value if confirm exists
            let passwordValue = '';
            form.querySelectorAll('input').forEach(input => {
                if (input.name === 'password') passwordValue = input.value.trim();
            });

            // Validate each input
            form.querySelectorAll('input').forEach(input => {
                const value = input.value.trim();
                let error = '';

                if (input.name === 'name') {
                    if (value.length < 3) error = 'Name must be at least 3 characters';
                }

                if (input.name === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) error = 'Please enter a valid email';
                }

                if (input.name === 'password') {
                    if (value.length < 6) error = 'Password must be at least 6 characters';
                }

                if (input.name === 'password_confirmation') {
                    if (value !== passwordValue) error = 'Passwords do not match';
                }

                if (error) {
                    isValid = false;
                    const errorEl = document.createElement('p');
                    errorEl.classList.add('error-text', 'text-red-500', 'text-sm', 'mt-1');
                    errorEl.textContent = error;
                    input.insertAdjacentElement('afterend', errorEl);
                }
            });

            if (!isValid) e.preventDefault();
        });

        // Remove error on typing
        form.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                const next = input.nextElementSibling;
                if (next && next.classList.contains('error-text')) next.remove();
            });
        });
    });
});
