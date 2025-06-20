import axios from 'axios';
import Alpine from 'alpinejs';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Initialize Alpine.js with error handling
try {
    window.Alpine = Alpine;

    // Define store before Alpine.start()
    Alpine.store('sidebar', {
        dropdownOpen: {}
    });

    // Start Alpine after store is defined
    Alpine.start();
    console.log('Alpine.js initialized successfully');
} catch (error) {
    console.error('Error initializing Alpine.js:', error);
}