
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Note: Vue.js has been removed to simplify the build process
// If you need Vue.js functionality, you can add it back later

/**
 * Simple example of modern JavaScript without framework dependencies
 */

// Example: Simple DOM manipulation
document.addEventListener('DOMContentLoaded', function() {
    console.log('FundooNotes application loaded successfully');
    
    // Add any custom JavaScript functionality here
    const appElement = document.getElementById('app');
    if (appElement) {
        appElement.setAttribute('data-status', 'loaded');
    }
});
