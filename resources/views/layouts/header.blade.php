<header class="bg-white shadow-sm sticky top-0 z-40 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Left side - Logo and Menu -->
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none transition-colors duration-200"
                    id="menuButton">
                    <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition-colors duration-200">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            <!-- Center - Navigation Links -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('inspired-designs') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('messages.header.inspired_designs') }}
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('project.index') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.estimated_home_cost') }}
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('land.exchange.index') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.land_purchase_initiative') }}
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('project.items.index') }}"
                    class="px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200 relative group">
                    {{ __('home.header.my_projects') }}
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>

            <!-- Right side - Language and Auth Links -->
            <div class="flex items-center space-x-4">
                <!-- Language Switcher -->
                <a href="{{ route('language.switch', ['lang' => app()->getLocale() === 'en' ? 'ar' : 'en']) }}"
                    class="hidden md:flex items-center px-3 py-2 text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    {{ app()->getLocale() === 'en' ? __('messages.header.arabic') : __('messages.header.english') }}
                </a>

                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                        {{ __('messages.header.login') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="hidden md:block px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                        {{ __('messages.header.register') }}
                    </a>
                @else
                    <!-- Messages Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-envelope"></i>
                            @if(isset($unreadCount) && $unreadCount > 0)
                                <span class="badge bg-danger">{{ $unreadCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messagesDropdown" style="min-width: 350px;">
                            <li class="dropdown-header">الرسائل الأخيرة</li>
                            @if(isset($headerConversations))
                                @forelse($headerConversations as $conv)
                                    @php
                                        $otherUser = $conv->sender_id == auth()->id() ? $conv->recipient : $conv->sender;
                                        $lastMessage = $conv->messages()->latest()->first();
                                    @endphp
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('messages.index', ['recipient_id' => $otherUser->id]) }}">
                                            <img src="{{ asset('storage/' . ($otherUser->image ?? 'users/user.png')) }}" class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <div>{{ $otherUser->first_name }} {{ $otherUser->last_name }}</div>
                                                <small class="text-muted">{{ $lastMessage ? Str::limit($lastMessage->message, 30) : 'لا توجد رسائل' }}</small>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="dropdown-item text-center text-muted">لا توجد رسائل</li>
                                @endforelse
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="{{ route('messages.index') }}">عرض كل الرسائل</a></li>
                        </ul>
                    </li>

                    <!-- Notifications Dropdown -->
                    <div class="relative">
                        <button type="button" class="p-2 rounded-full hover:bg-gray-100 focus:outline-none relative"
                            id="notificationsButton">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 h-3 w-3 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Notifications Dropdown Menu -->
                        <div class="hidden absolute right-0 mt-2 w-72 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
                            id="notificationsMenu">
                            <div class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-900">{{ __('messages.header.notifications') }}</p>
                            </div>
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    {{ __('messages.header.no_new_notifications') }}
                                </a>
                            </div>
                            <div class="py-1">
                                <a href=""
                                    class="block px-4 py-2 text-sm text-center text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                                    {{ __('messages.header.view_all_notifications') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button type="button" class="flex items-center focus:outline-none group" id="user-menu-button">
                            <div
                                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden border-2 border-transparent group-hover:border-indigo-200 transition-colors duration-200">
                                @if (auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Picture"
                                        class="h-full w-full object-cover">
                                @else
                                    <span class="text-lg font-medium text-indigo-800">
                                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                    </span>
                                @endif
                            </div>
                            <svg class="ml-1 h-4 w-4 text-gray-500 group-hover:text-gray-700 transition-colors duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="hidden absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
                            id="user-menu">
                            <!-- User Info -->
                            <div class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ auth()->user()->first_name ?? '' }}
                                    {{ auth()->user()->last_name ?? '' }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                            </div>

                           <!-- Navigation Links -->
<div class="py-1">
    <a href="{{ route(auth()->user()->role . '.dashboard') }}"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2" />
        </svg>
        {{ __('messages.dashboard.' . auth()->user()->role) }}
    </a>
    <a href="{{ route(auth()->user()->role . '.profile.edit') }}"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        {{ __('messages.profile.title') }}
    </a>
</div>

                            <!-- Logout -->
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('messages.auth.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>

<style>
    /* Smooth transitions for interactive elements */
    #user-menu,
    #messagesMenu,
    #notificationsMenu {
        transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        transform-origin: top right;
        opacity: 0;
        transform: scale(0.95);
        pointer-events: none;
    }

    #user-menu.show,
    #messagesMenu.show,
    #notificationsMenu.show {
        opacity: 1;
        transform: scale(1);
        pointer-events: auto;
    }

    /* Mobile menu button animation */
    #menuButton:hover svg {
        transform: scale(1.1);
        transition: transform 0.2s ease-in-out;
    }

    /* Notification badges */
    .relative .absolute {
        transform: translate(25%, -25%);
    }ئ

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .md\:flex {
            display: none;
        }

        /* Mobile language switcher */
        .hidden.md\:flex {
            display: none;
        }
    }

    /* Active nav link indicator */
    .router-link-active {
        color: #4f46e5;
    }

    .router-link-active span {
        width: 100%;
    }

    /* Messages Popup Styles */
    #messagesPopup {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    #messagesList {
        max-height: 60vh;
        overflow-y: auto;
    }

    .message-item {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        padding: 0.75rem 1rem;
        cursor: pointer;
        border-bottom: 1px solid #f3f4f6;
    }

    .message-item:hover {
        background-color: #f9fafb;
    }

    .message-item.unread {
        border-left-color: #4f46e5;
        background-color: #f5f3ff;
    }

    .message-sender {
        font-weight: 600;
        color: #1f2937;
        display: flex;
        align-items: center;
    }

    .message-time {
        font-size: 0.75rem;
        color: #6b7280;
        margin-left: auto;
    }

    .message-content {
        color: #4b5563;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 0.25rem;
    }

    .message-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        margin-right: 0.75rem;
        background-color: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        font-weight: 500;
    }

    /* Scrollbar styles */
    #messagesList::-webkit-scrollbar {
        width: 6px;
    }

    #messagesList::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #messagesList::-webkit-scrollbar-thumb {
        background: #c5c5c5;
        border-radius: 3px;
    }

    #messagesList::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Message form styles */
    #quickMessageForm textarea {
        min-height: 100px;
        resize: vertical;
    }

    /* Badge styles */
    #unreadMessagesBadge {
        top: -0.25rem;
        right: -0.25rem;
        width: 1.25rem;
        height: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Animation for new messages */
    @keyframes slideIn {
        from {
            transform: translateY(-10px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .new-message {
        animation: slideIn 0.3s ease-out;
    }

    /* Quick Message Form Styles */
    #quickMessageForm {
        position: relative;
    }

    /* Recipient Search Results */
    #recipientResults {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .recipient-item {
        padding: 0.5rem 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .recipient-item:hover {
        background-color: #f3f4f6;
    }

    .recipient-item.selected {
        background-color: #eef2ff;
    }

    /* Attachment Preview */
    .attachment-preview-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        background-color: #f9fafb;
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
    }

    .attachment-preview-item img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 0.25rem;
    }

    /* Emoji Picker */
    #emojiPicker {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 0.25rem;
        width: 300px;
    }

    .emoji-item {
        cursor: pointer;
        padding: 0.25rem;
        text-align: center;
        border-radius: 0.25rem;
    }

    .emoji-item:hover {
        background-color: #f3f4f6;
    }

    /* Voice Recorder */
    #voiceRecorder {
        width: 300px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 640px) {
        #emojiPicker {
            width: 100%;
            grid-template-columns: repeat(6, 1fr);
        }

        #voiceRecorder {
            width: 100%;
        }

        .attachment-preview-item {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* Animations */
    @keyframes slideUp {
        from {
            transform: translateY(10px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-slide-up {
        animation: slideUp 0.2s ease-out;
    }

    #messagesPopup .inline-block {
        max-height: 90vh !important;
        height: auto !important;
        overflow-y: auto !important;
    }
</style>

<script>
    const API_BASE = '/api';
    let currentUserId = {{ auth()->id() }};

    // Load recent conversations/messages for dropdown
    async function loadDropdownMessages() {
        const list = document.getElementById('dropdownMessagesList');
        list.innerHTML = '<div class="text-center py-4 text-gray-400 text-sm">جاري تحميل الرسائل...</div>';
        try {
            const res = await fetch(`${API_BASE}/conversations`, {headers: {'Accept': 'application/json'}});
            const data = await res.json();
            if (data.success && data.conversations.length > 0) {
                list.innerHTML = '';
                data.conversations.slice(0, 5).forEach(conv => {
                    const otherUser = conv.sender_id === currentUserId ? conv.recipient : conv.sender;
                    const lastMsg = conv.messages && conv.messages.length > 0 ? conv.messages[0] : null;
                    const preview = lastMsg ? (lastMsg.image ? '📷 صورة' : lastMsg.voice_note ? '🎤 رسالة صوتية' : (lastMsg.message || '')) : 'لا توجد رسائل';
                    const time = lastMsg ? new Date(lastMsg.created_at).toLocaleTimeString() : '';
                    list.innerHTML += `
                    <div class="flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer" onclick="window.location.href='/messages/${otherUser.id}'">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                            <span class="text-indigo-700 font-bold">${otherUser.first_name.charAt(0)}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">${otherUser.first_name} ${otherUser.last_name}</p>
                            <p class="text-xs text-gray-500 truncate">${preview}</p>
                        </div>
                        <span class="text-xs text-gray-400 ml-2">${time}</span>
                    </div>`;
                });
            } else {
                list.innerHTML = '<div class="text-center py-4 text-gray-400 text-sm">لا توجد رسائل</div>';
            }
        } catch (e) {
            list.innerHTML = '<div class="text-center py-4 text-red-400 text-sm">فشل تحميل الرسائل</div>';
        }
    }

    // Load users for quick message select
    async function loadQuickMessageUsers() {
        const select = document.getElementById('quickReceiver');
        select.innerHTML = '<option value="">اختر المستلم</option>';
        try {
            const res = await fetch('/api/users', {headers: {'Accept': 'application/json'}});
            const data = await res.json();
            if (data.success && data.users.length > 0) {
                data.users.forEach(user => {
                    if (user.id !== currentUserId) {
                        select.innerHTML += `<option value="${user.id}">${user.first_name} ${user.last_name}</option>`;
                    }
                });
            }
        } catch (e) {}
    }

    // Send quick message via AJAX
    async function sendQuickMessage(event) {
        event.preventDefault();
        const receiverId = document.getElementById('quickReceiver').value;
        const content = document.getElementById('quickMessageContent').value.trim();
        if (!receiverId || !content) {
            alert('يرجى اختيار مستلم وكتابة رسالة.');
            return false;
        }
        const formData = new FormData();
        formData.append('recipient_id', receiverId);
        formData.append('message', content);
        try {
            const res = await fetch(`${API_BASE}/messages`, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: formData
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('quickMessageContent').value = '';
                await loadDropdownMessages();
                alert('تم إرسال الرسالة بنجاح!');
            } else {
                alert(data.message || 'فشل إرسال الرسالة');
            }
        } catch (e) {
            alert('فشل إرسال الرسالة');
        }
        return false;
    }

    // Real-time updates with Echo
    if (window.Echo) {
        window.Echo.private('messages.' + currentUserId)
            .listen('NewMessage', (e) => {
                loadDropdownMessages();
            });
    }

    // Dropdown open/close logic
    function toggleMessagesDropdown() {
        const dropdown = document.getElementById('messagesDropdown');
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden')) {
            loadDropdownMessages();
            loadQuickMessageUsers();
        }
    }
   document.addEventListener('click', function(e) {
    const modal = document.getElementById('offer-modal');
    if (modal && !modal.contains(e.target)) {
        modal.classList.add('hidden');
    }

    const messagesDropdown = document.getElementById('messagesDropdown');
    if (messagesDropdown && !messagesDropdown.contains(e.target)) {
        messagesDropdown.classList.add('hidden');
    }
});

</script>

<script>
    // Enhanced dropdown menu with animations
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('show');
            userMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (userMenu.classList.contains('show')) {
                userMenu.classList.remove('show');
                setTimeout(() => userMenu.classList.add('hidden'), 200);
            }
        });
    }

    // Messages dropdown
    const messagesButton = document.getElementById('messagesButton');
    const messagesMenu = document.getElementById('messagesMenu');

    if (messagesButton && messagesMenu) {
        messagesButton.addEventListener('click', (e) => {
            e.stopPropagation();
            messagesMenu.classList.toggle('show');
            messagesMenu.classList.toggle('hidden');
            // Close notifications menu if open
            if (notificationsMenu.classList.contains('show')) {
                notificationsMenu.classList.remove('show');
                setTimeout(() => notificationsMenu.classList.add('hidden'), 200);
            }
        });
    }

    // Notifications dropdown
    const notificationsButton = document.getElementById('notificationsButton');
    const notificationsMenu = document.getElementById('notificationsMenu');

    if (notificationsButton && notificationsMenu) {
        notificationsButton.addEventListener('click', (e) => {
            e.stopPropagation();
            notificationsMenu.classList.toggle('show');
            notificationsMenu.classList.toggle('hidden');
            // Close messages menu if open
            if (messagesMenu.classList.contains('show')) {
                messagesMenu.classList.remove('show');
                setTimeout(() => messagesMenu.classList.add('hidden'), 200);
            }
        });
    }

    // Close all dropdowns when clicking outside
    document.addEventListener('click', () => {
        [userMenu, messagesMenu, notificationsMenu].forEach(menu => {
            if (menu && menu.classList.contains('show')) {
                menu.classList.remove('show');
                setTimeout(() => menu.classList.add('hidden'), 200);
            }
        });
    });

    // Mobile menu toggle with animation
    const menuButton = document.getElementById('menuButton');
    if (menuButton) {
        menuButton.addEventListener('click', () => {
            // You would add mobile menu functionality here
            console.log('Mobile menu toggled');
        });
    }
</script>

<script>
// Message Form Functionality
let selectedRecipients = new Set();
let attachments = new Map();
let isRecording = false;
let recordingStartTime = null;
let recordingTimer = null;

// Handle message input
function handleMessageInput(textarea) {
    const charCount = textarea.value.length;
    document.getElementById('charCount').textContent = charCount;

    // Enable/disable send button
    const sendButton = document.getElementById('sendButton');
    sendButton.disabled = charCount === 0 || selectedRecipients.size === 0;
}

// Handle file selection
function handleFileSelect(input) {
    const files = Array.from(input.files);
    const preview = document.getElementById('attachmentPreview');
    preview.classList.remove('hidden');

    files.forEach(file => {
        if (attachments.has(file.name)) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const previewItem = document.createElement('div');
            previewItem.className = 'attachment-preview-item animate-slide-up';

            if (file.type.startsWith('image/')) {
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(1)} KB</p>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeAttachment('${file.name}')">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
                    </button>
                `;
            } else {
                previewItem.innerHTML = `
                    <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(1)} KB</p>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeAttachment('${file.name}')">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
            }

            preview.appendChild(previewItem);
            attachments.set(file.name, file);
        };

        reader.readAsDataURL(file);
    });
}

// Remove attachment
function removeAttachment(fileName) {
    attachments.delete(fileName);
    const preview = document.getElementById('attachmentPreview');
    const items = preview.querySelectorAll('.attachment-preview-item');

    items.forEach(item => {
        if (item.querySelector('p').textContent === fileName) {
            item.remove();
        }
    });

    if (attachments.size === 0) {
        preview.classList.add('hidden');
    }
}

// Toggle emoji picker
function toggleEmojiPicker() {
    const picker = document.getElementById('emojiPicker');
    picker.classList.toggle('hidden');

    if (!picker.classList.contains('hidden')) {
        // Load emojis if not already loaded
        if (!picker.hasChildNodes()) {
            const emojis = ['😊', '😂', '❤️', '👍', '🎉', '🔥', '🙏', '👏', '🤔', '😍', '😎', '🤗', '😴', '😢', '😡', '😱'];
            emojis.forEach(emoji => {
                const span = document.createElement('span');
                span.className = 'emoji-item';
                span.textContent = emoji;
                span.onclick = () => insertEmoji(emoji);
                picker.appendChild(span);
            });
        }
    }
}

// Insert emoji
function insertEmoji(emoji) {
    const textarea = document.getElementById('quickMessageContent');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const newText = text.substring(0, start) + emoji + text.substring(end);
    textarea.value = newText;
    textarea.selectionStart = textarea.selectionEnd = start + emoji.length;
    handleMessageInput(textarea);
    document.getElementById('emojiPicker').classList.add('hidden');
}

// Toggle voice recorder
function toggleVoiceRecorder() {
    const recorder = document.getElementById('voiceRecorder');
    recorder.classList.toggle('hidden');

    if (!recorder.classList.contains('hidden')) {
        // Initialize voice recorder
        initializeVoiceRecorder();
    } else {
        stopRecording();
    }
}

// Initialize voice recorder
function initializeVoiceRecorder() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        showAlert('error', 'Voice recording is not supported in your browser');
        return;
    }

    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
            const mediaRecorder = new MediaRecorder(stream);
            const audioChunks = [];

            mediaRecorder.ondataavailable = (event) => {
                audioChunks.push(event.data);
            };

            mediaRecorder.onstop = () => {
                const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                const audioUrl = URL.createObjectURL(audioBlob);

                // Add audio attachment
                const fileName = `voice-message-${Date.now()}.wav`;
                attachments.set(fileName, audioBlob);

                const preview = document.getElementById('attachmentPreview');
                preview.classList.remove('hidden');

                const previewItem = document.createElement('div');
                previewItem.className = 'attachment-preview-item animate-slide-up';
                previewItem.innerHTML = `
                    <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">${fileName}</p>
                        <p class="text-xs text-gray-500">Voice Message</p>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeAttachment('${fileName}')">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;

                preview.appendChild(previewItem);
            };

            window.mediaRecorder = mediaRecorder;
        })
        .catch(error => {
            console.error('Error accessing microphone:', error);
            showAlert('error', 'Could not access microphone');
        });
}

// Start recording
function startRecording() {
    if (!window.mediaRecorder) return;

    isRecording = true;
    recordingStartTime = Date.now();
    window.mediaRecorder.start();

    // Update recording time
    recordingTimer = setInterval(() => {
        const elapsed = Math.floor((Date.now() - recordingStartTime) / 1000);
        const minutes = Math.floor(elapsed / 60);
        const seconds = elapsed % 60;
        document.getElementById('recordingTime').textContent =
            `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);

    // Simulate recording level
    const level = document.getElementById('recordingLevel');
    setInterval(() => {
        if (isRecording) {
            const width = Math.random() * 100;
            level.style.width = `${width}%`;
        }
    }, 100);
}

// Stop recording
function stopRecording() {
    if (!window.mediaRecorder || !isRecording) return;

    isRecording = false;
    clearInterval(recordingTimer);
    window.mediaRecorder.stop();
    document.getElementById('recordingTime').textContent = '0:00';
    document.getElementById('recordingLevel').style.width = '0%';
    document.getElementById('voiceRecorder').classList.add('hidden');
}

// Send message
async function sendQuickMessage(event) {
    event.preventDefault();
    const receiverId = document.getElementById('quickReceiver').value;
    const content = document.getElementById('quickMessageContent').value.trim();
    const submitButton = event.target.querySelector('button[type="submit"]');
    if (!receiverId || !content) {
        alert('Please select a recipient and type a message.');
        return;
    }
    // Show loading state
    {{--  const originalButton = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = `<svg class='animate-spin h-4 w-4 mr-2 text-white' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'><circle class='opacity-25' cx='12' cy='12' r='10' stroke='currentColor' stroke-width='4'></circle><path class='opacity-75' fill='currentColor' d='M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z'></path></svg> Sending...`;
    try {
        const response = await fetch("{{ route('sendMessage', ['recipient_id' => $recipient->id]) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                content: content
            })
        });
        const data = await response.json();
        if (data.success) {
            document.getElementById('quickMessageContent').value = '';
            // Optionally reload messages list
            if (typeof loadMessages === 'function') loadMessages();
            alert('Message sent successfully!');
        } else {
            alert(data.message || 'Failed to send message.');
        }
    } catch (error) {
        alert('Error sending message. Please try again.');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButton;
    }  --}}
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Handle recipient search
    const searchInput = document.getElementById('recipientSearch');
    const resultsDiv = document.getElementById('recipientResults');

    searchInput.addEventListener('input', debounce(async function(e) {
        const term = e.target.value.trim();
        if (term.length < 2) {
            resultsDiv.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(`/users/search?term=${encodeURIComponent(term)}`);
            const users = await response.json();

            resultsDiv.innerHTML = users.map(user => `
                <div class="recipient-item" data-id="${user.id}">
                    <img src="${user.avatar_url}" alt="${user.name}" class="w-6 h-6 rounded-full">
                    <span>${user.name}</span>
                </div>
            `).join('');

            resultsDiv.classList.remove('hidden');

            // Add click handlers
            resultsDiv.querySelectorAll('.recipient-item').forEach(item => {
                item.addEventListener('click', function() {
                    const userId = this.dataset.id;
                    const userName = this.querySelector('span').textContent;

                    if (selectedRecipients.has(userId)) {
                        selectedRecipients.delete(userId);
                        this.classList.remove('selected');
                    } else {
                        selectedRecipients.add(userId);
                        this.classList.add('selected');
                    }

                    searchInput.value = '';
                    resultsDiv.classList.add('hidden');
                });
            });
        } catch (error) {
            console.error('Error searching users:', error);
        }
    }, 300));

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#quickMessageForm')) {
            document.getElementById('emojiPicker').classList.add('hidden');
            document.getElementById('voiceRecorder').classList.add('hidden');
            document.getElementById('recipientResults').classList.add('hidden');
        }
    });
});
</script>
