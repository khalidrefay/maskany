import './bootstrap';

// Laravel Echo configuration
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for new messages
window.Echo.private(`messages.${userId}`)
    .listen('NewMessage', (e) => {
        updateMessagesList(e.message);
        updateUnreadCount();
        showNotification(e.message);
    });
