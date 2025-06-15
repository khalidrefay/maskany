@extends('layouts.app')
@section('css')
<style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        /* Start Project Journey Section */
        .start-journey {
            width: 100%;
            background-color: #E7E5F9;
            padding-top: 9rem;
            padding-bottom: 2rem;
            min-height: 100vh;
        }

        .journey-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            background-color: #F7F8F8;
            padding: 2.5rem;
            border-radius: 2rem;
            width: 90%;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .journey-container {
                grid-template-columns: 2fr 1fr;
            }
        }

        .journey-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .journey-title {
            font-weight: 700;
            font-size: 3rem;
            color: #333;
        }

        .journey-title span {
            color: #1E90FF;
        }

        .journey-subtitle {
            font-weight: 500;
            font-size: 1.5rem;
            color: #808080;
        }

        .journey-image {
            border-radius: 2rem;
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        @media (min-width: 1024px) {
            .journey-image {
                width: 83%;
            }
        }

        .journey-button {
            background-color: #1E90FF;
            border-radius: 0.375rem;
            height: 3rem;
            padding: 0 1.5rem;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        @media (min-width: 1024px) {
            .mobile-button {
                display: none;
            }
        }

        .stats-section {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .stats-section {
                display: flex;
            }
        }

        .stats-number {
            font-weight: 700;
            font-size: 3rem;
            color: #333;
        }

        .stats-description {
            font-weight: 500;
            font-size: 1.25rem;
            color: #333;
            width: 80%;
        }

        .vision-title {
            font-weight: 700;
            font-size: 1.875rem;
            color: #333;
        }

        /* Build Steps Section */
        .build-steps {
            width: 100%;
            background-color: white;
            padding: 2.5rem 0;
            min-height: 100vh;
        }

        .steps-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            border-radius: 0.75rem;
            width: 90%;
            margin: 0 auto;
            background-color: #F7F7FD;
            padding: 0.5rem;
            padding-bottom: 2.5rem;
        }

        @media (min-width: 1024px) {
            .steps-container {
                grid-template-columns: 2fr 1fr;
            }
        }

        .steps-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            order: 1;
        }

        @media (min-width: 1024px) {
            .steps-content {
                align-items: flex-start;
                order: 0;
            }
        }

        .steps-title {
            font-weight: 700;
            font-size: 3rem;
            color: #333333;
            text-align: center;
        }

        @media (min-width: 1024px) {
            .steps-title {
                text-align: left;
            }
        }

        .steps-subtitle {
            font-weight: 500;
            font-size: 1.25rem;
            color: #333333;
            text-align: center;
        }

        @media (min-width: 1024px) {
            .steps-subtitle {
                text-align: left;
            }
        }

        .steps-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 1024px) {
            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1280px) {
            .steps-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .step-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .step-title {
            color: #000929;
            font-size: 1rem;
            font-weight: 700;
            text-align: center;
        }

        .step-desc {
            color: #808080;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
        }

        .steps-image-container {
            display: flex;
            justify-content: center;
            order: 1;
        }

        @media (min-width: 1024px) {
            .steps-image-container {
                order: 1;
            }
        }

        .steps-image {
            object-fit: cover;
            width: 100%;
            max-width: 530px;
            height: 530px;
        }

        @media (min-width: 1024px) {
            .steps-image {
                border-top-right-radius: 10rem;
            }
        }

        /* Project Cost Section */
        .project-cost {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(to bottom, #E7E5F9, #1E90FF);
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        @media (min-width: 1024px) {
            .project-cost {
                border-bottom-left-radius: 50%;
                border-bottom-right-radius: 50%;
            }
        }

        .cost-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding-top: 5rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        @media (min-width: 768px) {
            .cost-header {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
        }

        @media (min-width: 1024px) {
            .cost-header {
                padding-left: 5rem;
                padding-right: 5rem;
            }
        }

        .cost-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #4361EE;
        }

        .cost-subtitle {
            font-size: 1.5rem;
            color: #002F5C;
            font-weight: bold;
        }

        @media (min-width: 768px) {
            .cost-subtitle {
                font-size: 1.875rem;
            }
        }

        .cost-main {
            width: 100%;
            flex-grow: 1;
            padding: 2rem 1.25rem;
        }

        @media (min-width: 768px) {
            .cost-main {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
        }

        @media (min-width: 1024px) {
            .cost-main {
                padding-top: 4rem;
                padding-bottom: 4rem;
                padding-left: 5rem;
                padding-right: 5rem;
            }
        }

        .cost-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            max-width: 72rem;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .cost-content {
                flex-direction: row;
                gap: 4.5rem;
            }
        }

        .cost-image-container {
            width: 100%;
            margin-bottom: 2rem;
        }

        @media (min-width: 1024px) {
            .cost-image-container {
                width: 50%;
                margin-bottom: 0;
            }
        }

        .cost-image {
            object-fit: cover;
            width: 100%;
            height: auto;
            max-height: 500px;
            border-top-left-radius: 100px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @media (min-width: 1024px) {
            .cost-image {
                margin-left: 5rem;
            }
        }

        .steps-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            width: 100%;
        }

        @media (min-width: 1024px) {
            .steps-container {
                width: 50%;
            }
        }

        .step-item {
            position: relative;
            width: 100%;
            gap: 1.25rem;
            max-width: 28rem;
        }

        .step-number {
            position: absolute;
            top: -0.75rem;
            right: -0.75rem;
            background-color: #4361EE;
            color: white;
            width: 1.75rem;
            height: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .step-button {
            width: 100%;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 1.25rem;
            border: none;
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .step-button:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .step-text {
            font-weight: bold;
        }

        .try-button {
            background-color: #4361EE;
            color: white;
            border: none;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        /* About Inshaat Section */
        .about-inshaat {
            width: 100%;
            background-color: #F3F3F3;
            padding: 5rem 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about-container {
            max-width: 80rem;
            width: 100%;
            text-align: center;
        }

        .about-title {
            font-size: 1.875rem;
            margin-bottom: 1rem;
            color: #1E90FF;
            font-weight: bold;
        }

        .about-subtitle {
            font-size: 1.5rem;
            color: #808080;
            font-weight: 600;
            margin-bottom: 3rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .stat-card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            background-color: #4361EE;
            color: white;
            border-radius: 9999px;
            padding: 1rem;
        }

        .stat-number {
            color: #4361EE;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .stat-desc {
            color: #333;
            text-align: center;
            max-width: 250px;
            line-height: 1.625;
        }

        /* Comment Section */
        .comment-section {
            background-color: white;
            padding: 5rem 1rem;
        }

        .comment-container {
            max-width: 72rem;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 2.5rem;
        }

        @media (min-width: 768px) {
            .comment-container {
                flex-direction: row;
            }
        }

        .comment-content {
            width: 100%;
        }

        @media (min-width: 768px) {
            .comment-content {
                width: auto;
                order: 0;
            }
        }

        .comment-label {
            color: #4361EE;
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
        }

        .comment-title {
            color: #2B2B2B;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .comment-buttons {
            display: none;
            gap: 1rem;
            margin-top: 5rem;
        }

        @media (min-width: 768px) {
            .comment-buttons {
                display: flex;
            }
        }

        .comment-button {
            padding: 0.75rem;
            border: 1px solid #4361EE;
            border-radius: 9999px;
            cursor: pointer;
        }

        .comment-button:hover {
            background-color: #F3F4F6;
        }

        .comment-card {
            position: relative;
            cursor: pointer;
            background-color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
            padding: 2.5rem;
            max-width: 28rem;
            width: 100%;
            order: 2;
        }

        @media (min-width: 768px) {
            .comment-card {
                order: 0;
            width: auto;
            max-width: 28rem;
            margin-left: auto;
            margin-right: 0;
            margin-top: 0;
            margin-bottom: 0;
            order: 0;
            width: auto;
        }
        }

        .comment-icon {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
        }

        .comment-text {
            color: #4B5563;
            margin-bottom: 1.5rem;
            line-height: 1.75;
        }

        .comment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-stars {
            display: flex;
            gap: 0.25rem;
            color: #F59E0B;
        }

        .comment-user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-name {
            color: #3A0CA3;
            font-weight: 700;
        }

        .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
        }

        .mobile-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        @media (min-width: 768px) {
            .mobile-buttons {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Start Project Journey Section -->
    <section class="start-journey">
        <div class="journey-container">
            <div class="journey-content">
                <h1 class="journey-title">
                    <span>Start</span> your project journey!
                </h1>
                <div class="flex flex-col gap-2">
                    <p class="journey-subtitle">A better future for you and your family</p>
                    <p class="journey-subtitle">Implementing your ideas, dreams and everything you want is just one step away from now</p>
                </div>
                <img src="{{ asset('images/start-project.png') }}" style="width: 590px;, height: 390px;" alt="Start your project" class="journey-image">
                <button class="journey-button mobile-button">
                    Login
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 11.8175L1.5 6.81751L6.5 1.81751" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="stats-section">
                <div class="flex flex-col items-center gap-6">
                    <p class="stats-number">3.5k+</p>
                    <p class="stats-description">Description about the number</p>
                </div>
                <div class="flex flex-col items-start gap-6">
                    <p class="vision-title">A comprehensive vision for estimating the cost of your project with the Insha platform</p>
                    <button class="journey-button">
                        Login
                        <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.5 11.8175L1.5 6.81751L6.5 1.81751" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Build Steps Section -->
    <section class="build-steps">
        <div class="steps-container">
            <div class="steps-content">
                <p class="steps-title">Build your project in 6 steps</p>
                <p class="steps-subtitle">Follow these steps to build your project</p>
                <div class="steps-grid">
                    <div class="step-card">
                        <img src="https://example.com/step1.jpg" alt="Step 1" class="cursor-pointer">
                        <p class="step-title">Step 1 Title</p>
                        <p class="step-desc">Step 1 Description</p>
                    </div>
                    <div class="step-card">
                        <img src="https://example.com/step2.jpg" alt="Step 2" class="cursor-pointer">
                        <p class="step-title">Step 2 Title</p>
                        <p class="step-desc">Step 2 Description</p>
                    </div>
                    <div class="step-card">
                        <img src="https://example.com/step3.jpg" alt="Step 3" class="cursor-pointer">
                        <p class="step-title">Step 3 Title</p>
                        <p class="step-desc">Step 3 Description</p>
                    </div>
                    <div class="step-card">
                        <img src="https://example.com/step4.jpg" alt="Step 4" class="cursor-pointer">
                        <p class="step-title">Step 4 Title</p>
                        <p class="step-desc">Step 4 Description</p>
                    </div>
                    <div class="step-card">
                        <img src="https://example.com/step5.jpg" alt="Step 5" class="cursor-pointer">
                        <p class="step-title">Step 5 Title</p>
                        <p class="step-desc">Step 5 Description</p>
                    </div>
                    <div class="step-card">
                        <img src="https://example.com/step6.jpg" alt="Step 6" class="cursor-pointer">
                        <p class="step-title">Step 6 Title</p>
                        <p class="step-desc">Step 6 Description</p>
                    </div>
                </div>
            </div>
            <div class="steps-image-container">
                <img src="https://example.com/build-your-project.jpg" alt="Build your project" class="steps-image">
            </div>
        </div>
    </section>

    <!-- Project Cost Section -->
    <section class="project-cost">
        <div class="cost-header">
            <h1 class="cost-title">Project Cost</h1>
            <p class="cost-subtitle">Estimate the cost of your project in 3 easy steps</p>
        </div>
        <div class="cost-main">
            <div class="cost-content">
                <div class="cost-image-container">
                    <img src="https://example.com/choose-images.jpg" alt="Project cost estimation" class="cost-image">
                </div>
                <div class="steps-container">
                    <div class="step-item">
                        <span class="step-number">1</span>
                        <button class="step-button">
                            <p class="step-text">Step 1: Enter project details</p>
                        </button>
                    </div>
                    <div class="step-item">
                        <span class="step-number">2</span>
                        <button class="step-button">
                            <p class="step-text">Step 2: Select materials</p>
                        </button>
                    </div>
                    <div class="step-item">
                        <span class="step-number">3</span>
                        <button class="step-button">
                            <p class="step-text">Step 3: Get your estimate</p>
                        </button>
                    </div>
                    <button class="try-button">
                        Try it now
                        <img src="https://example.com/vector-icon.svg" alt="Arrow icon" class="mx-10">
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Inshaat Section -->
    <section class="about-inshaat">
        <div class="about-container">
            <h1 class="about-title">About Inshaat</h1>
            <p class="about-subtitle">The best platform for your construction needs</p>
            <p class="about-subtitle">Connecting you with the best professionals in the industry</p>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <img src="https://example.com/search-icon.svg" alt="Search icon">
                    </div>
                    <h2 class="stat-number">500+</h2>
                    <p class="stat-desc">Suppliers available for your project</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <img src="https://example.com/user-icon.svg" alt="User icon">
                    </div>
                    <h2 class="stat-number">200+</h2>
                    <p class="stat-desc">Consultants ready to help</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <img src="https://example.com/home-icon.svg" alt="Home icon">
                    </div>
                    <h2 class="stat-number">1000+</h2>
                    <p class="stat-desc">Projects completed successfully</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Comment Section -->
    <section class="comment-section">
        <div class="comment-container">
            <div class="comment-content">
                <p class="comment-label">Testimonials</p>
                <h3 class="comment-title">What our clients say about us</h3>
                <div class="comment-buttons">
                    <button class="comment-button">
                        <img src="https://example.com/arrow-left.svg" alt="Previous">
                    </button>
                    <button class="comment-button">
                        <img src="https://example.com/arrow-right.svg" alt="Next">
                    </button>
                </div>
            </div>
            <div class="comment-card">
                <img src="https://example.com/comment-icon.svg" alt="Comment icon" class="comment-icon">
                <p class="comment-text">"Inshaat helped me find the perfect contractor for my home renovation. The platform is easy to use and saved me so much time and money!"</p>
                <div class="comment-footer">
                    <div class="comment-stars">
                        <img src="https://example.com/stars-icon.svg" alt="5 stars">
                    </div>
                    <div class="comment-user">
                        <span class="user-name">John Doe</span>
                        <img src="https://example.com/user-avatar.jpg" alt="User avatar" class="user-avatar">
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-buttons">
            <button class="comment-button">
                <img src="https://example.com/arrow-left.svg" alt="Previous">
            </button>
            <button class="comment-button">
                <img src="https://example.com/arrow-right.svg" alt="Next">
            </button>
        </div>
    </section>
@endsection
@section('js')
    <script>
        // Simple script for testimonial carousel
        const testimonials = [
            {
                text: '"Inshaat helped me find the perfect contractor for my home renovation. The platform is easy to use and saved me so much time and money!"',
                name: "John Doe"
            },
            {
                text: '"The cost estimation tool was incredibly accurate and helped me budget my project properly. Highly recommended!"',
                name: "Jane Smith"
            },
            {
                text: '"As a consultant, Inshaat has connected me with great clients and projects. It\'s been a game-changer for my business."',
                name: "Robert Johnson"
            }
        ];

        let currentTestimonial = 0;
        const testimonialText = document.querySelector('.comment-text');
        const testimonialName = document.querySelector('.user-name');

        function updateTestimonial() {
            testimonialText.textContent = testimonials[currentTestimonial].text;
            testimonialName.textContent = testimonials[currentTestimonial].name;
        }

        document.querySelectorAll('.comment-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const isNext = e.currentTarget.querySelector('img').alt === 'Next' ||
                              e.currentTarget.innerHTML.includes('arrow-right.svg');

                if (isNext) {
                    currentTestimonial = (currentTestimonial + 1) % testimonials.length;
                } else {
                    currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
                }

                updateTestimonial();
            });
        });

        // Initialize first testimonial
        updateTestimonial();
    </script>
@endsection
