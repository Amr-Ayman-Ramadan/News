import './bootstrap';

// Assuming `id` is the admin's ID
const id = window.adminId; // Pass this from your Blade template

// Listen to the private channel
window.Echo.private(`admins.${id}`)
    .listen('.NotificationEvent', (event) => {
        console.log('New notification:', event);

        // Append the new notification to the dropdown
        $('#notify_push').prepend(`
            <a class="dropdown-item d-flex align-items-center" href="">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="${event.image}" alt="Notification Icon">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">${event.contact_title || "No message available"}</div>
                    <div class="small text-gray-500">
                        ${event.date || new Date().toLocaleString()}
                    </div>
                </div>
            </a>
        `);

        // Update the notification badge count
        const badge = $('#notification-badge');
        const currentCount = parseInt(badge.text()) || 0;
        badge.text(currentCount + 1);
    });
