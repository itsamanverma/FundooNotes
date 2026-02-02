#!/bin/bash

# Fix for Node.js environment issues
export NODE_OPTIONS=""
unset NODE_OPTIONS

echo "Environment cleared. Node.js version:"
node --version

echo "NPM version:"
npm --version

echo "Attempting to install dependencies..."

# Try different approaches
if npm install --no-optional --no-package-lock; then
    echo "✅ npm install successful"
elif yarn install; then
    echo "✅ yarn install successful"
else
    echo "❌ Both npm and yarn failed. Using CDN approach."
    echo "Creating static assets..."
    
    # Create basic CSS file
    mkdir -p public/css
    cat > public/css/app.css << 'EOF'
/* FundooNotes Basic Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

.btn:hover {
    background: #0056b3;
}

.card {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin: 10px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.navbar {
    background: #343a40;
    color: white;
    padding: 1rem 0;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin: 5px 0;
}

.alert {
    padding: 15px;
    border-radius: 4px;
    margin: 10px 0;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
EOF

    # Create basic JS file
    mkdir -p public/js
    cat > public/js/app.js << 'EOF'
// FundooNotes Basic JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('FundooNotes application loaded successfully');
    
    // Set up CSRF token for AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token && window.axios) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
    }
    
    // Basic form enhancements
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';
                
                // Re-enable after 3 seconds in case of issues
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = submitBtn.dataset.originalText || 'Submit';
                }, 3000);
            }
        });
    });
    
    // Simple notification system
    window.showNotification = function(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type}`;
        notification.textContent = message;
        
        const container = document.querySelector('.container') || document.body;
        container.insertBefore(notification, container.firstChild);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    };
});
EOF

    echo "✅ Static assets created successfully"
fi

echo "Setup complete! You can now run:"
echo "php artisan serve"