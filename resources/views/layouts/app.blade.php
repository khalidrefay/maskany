<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        /* Header Styles */
        .header-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            height: 13vh;
            background-color: white;
            width: 100%;
            max-width: 90%;
            margin: 0 auto;
            position: fixed;
            top: 1rem;
            border-radius: 50px;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .header.scrolled {
            background-color: #111827;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 2rem;
            color: black;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
            width: 1.5rem;
            height: 1.5rem;
        }

        .auth-links {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: #3A0CA3;
        }

        .auth-link {
            color: #3A0CA3;
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }

        .auth-link:hover {
            background-color: rgba(58, 12, 163, 0.1);
        }

        .nav-links {
            display: none;
            align-items: center;
            font-weight: 700;
            color: #3A0CA3;
            font-size: 15px;
        }

        .nav-link {
            padding: 0 0.5rem;
            position: relative;
            display: inline-block;
            transition: all 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: -1px;
            left: 0;
            background-color: #facc15;
            transition: all 0.3s;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }

        .logo {
            width: 25%;
            object-fit: cover;
        }

        /* Mobile Nav Styles */
        .mobile-nav {
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 16rem;
            background-color: #3A0CA3;
            color: white;
            z-index: 1050;
            transform: translateX(100%);
            transition: transform 0.7s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
        }

        .mobile-nav.open {
            transform: translateX(0);
        }
        .navbar-nav .nav-link {
    padding: 0 15px;
    font-weight: 500;
}

.navbar-nav .nav-link:hover {
    color: #0d6efd;
}

.btn-primary {
    background-color: #4f46e5;
    border-color: #4f46e5;
    font-weight: bold;
    border-radius: 10px;
}


        .mobile-nav-link {
            margin-top: 1rem;
            width: fit-content;
            padding-bottom: 0.25rem;
            font-size: 1.25rem;
            margin-left: 1.5rem;
            color: white;
            transition: all 0.5s;
            position: relative;
        }

        .mobile-nav-link::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: -1px;
            left: 0;
            background-color: #facc15;
            transition: all 0.3s;
        }

        .mobile-nav-link:hover::after {
            transform: scaleX(1);
        }

        .close-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 1.5rem;
            height: 1.5rem;
            cursor: pointer;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding-top: 13vh;
        }

        /* Footer Styles */
        .footer {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-top: auto;
        }

        .footer-top {
            width: 100%;
            background-color: rgba(67, 97, 238, 0.1);
            padding: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            align-items: flex-end;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer-contact {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-contact img {
            width: 1rem;
            height: 1rem;
        }

        .footer-contact p, .footer-contact a {
            font-size: 0.8rem;
            font-weight: 700;
            color: #2B2B2B;
        }

        .footer-contact a {
            text-decoration: none;
        }

        .footer-contact a:hover {
            text-decoration: underline;
        }

        .footer-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #3A0CA3;
        }

        .newsletter {
            width: 100%;
        }

        .newsletter-input {
            background-color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-radius: 2rem;
            padding: 0.25rem 1rem;
        }

        .newsletter-input input {
            width: 100%;
            font-size: 0.8rem;
            height: 3.125rem;
            padding: 0 1rem;
            border: none;
            outline: none;
        }

        .newsletter-input img {
            width: 1rem;
            height: 1rem;
        }

        .footer-bottom {
            background-color: black;
            width: 100%;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            width: 90%;
            margin: 0 auto;
        }

        .footer-bottom p {
            color: white;
            font-size: 0.6rem;
            font-weight: 700;
        }

        /* Responsive Styles */
        @media (min-width: 768px) {
            .header {
                padding: 0 1rem;
            }

            .menu-icon {
                display: block;
            }

            .nav-links {
                display: flex;
            }

            .footer-top {
                padding: 3rem;
                gap: 1rem;
                justify-content: space-between;
            }

            .footer-section {
                gap: 1rem;
            }

            .footer-contact {
                gap: 1rem;
            }

            .footer-contact p, .footer-contact a {
                font-size: 1rem;
            }

            .footer-title {
                font-size: 1rem;
            }

            .newsletter {
                width: 33.3333%;
            }

            .newsletter-input input {
                font-size: 1rem;
            }
        }

        @media (min-width: 1024px) {
            .header {
                padding: 0 2rem;
            }

            .footer-top {
                padding: 5rem;
            }

            .footer-contact {
                gap: 1rem;
            }
        }
    </style>
    @yield('css')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.header')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')
    @yield('js')

    <script>
    window.openMessagesWith = function(userId) {
        if (typeof toggleMessagesDropdown === 'function') {
            toggleMessagesDropdown();
            setTimeout(function() {
                var receiverSelect = document.getElementById('quickReceiver');
                if (receiverSelect) receiverSelect.value = userId;
                var messageInput = document.getElementById('quickMessageContent');
                if (messageInput) messageInput.focus();
            }, 200);
        } else {
            alert('رسائل الهيدر غير متاحة في هذه الصفحة!');
        }
    }
    </script>
</body>
</html>
