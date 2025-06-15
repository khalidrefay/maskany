@extends('layouts.app')
@section('title', 'My Offer')
@section('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Tabs Navigation */
        .tabs-container {
            margin-top: 1.5rem;
        }

        .tabs-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 2rem;
            padding-bottom: 0.5rem;
            overflow-x: auto;
        }

        @media (min-width: 768px) {
            .tabs-nav {
                flex-direction: row;
                gap: 1.5rem;
            }
        }

        .tab-btn {
            position: relative;
            padding-bottom: 0.5rem;
            font-weight: 700;
            font-size: 0.875rem;
            transition: color 0.2s;
            cursor: pointer;
            white-space: nowrap;
            padding-right: 2.5rem;
            padding-left: 2.5rem;
            color: #6C6C89;
            border: none;
            background: none;
        }

        @media (min-width: 768px) {
            .tab-btn {
                font-size: 1rem;
            }
        }

        .tab-btn.active {
            color: #1E90FF;
        }

        .tab-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0.125rem;
            transition: background-color 0.3s;
            background-color: transparent;
        }

        .tab-btn.active .tab-indicator {
            background-color: #1E90FF;
        }

        /* Main Content */
        .main-content {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Browse Projects Section */
        .projects-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .project-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .project-grid {
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 1024px) {
            .project-grid {
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                gap: 0.5rem;
            }
        }

        .profile-section {
            padding: 1rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        @media (min-width: 1024px) {
            .profile-section {
                grid-column: span 3;
            }
        }

        .avatar {
            width: 4rem;
            height: 4rem;
            border-radius: 9999px;
            object-fit: cover;
            margin-bottom: 0.5rem;
        }

        .office-name {
            font-size: 1.125rem;
            font-weight: 500;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        @media (min-width: 1024px) {
            .office-name {
                font-size: 1.25rem;
            }
        }

        .details-section {
            padding: 0.5rem;
            border: 1px solid #1E90FF;
            border-radius: 0.75rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        @media (min-width: 1024px) {
            .details-section {
                grid-column: span 7;
            }
        }

        .file-info {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #344054;
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .file-icon {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.5rem;
        }

        .browse-btn {
            background-color: rgba(16, 24, 40, 0.05);
            color: #1E90FF;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid #1E90FF;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0 auto;
            cursor: pointer;
        }

        .download-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .actions-section {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        @media (min-width: 1024px) {
            .actions-section {
                grid-column: span 2;
                margin-top: 1.25rem;
            }
        }

        .publish-btn {
            background-color: #4361EE;
            color: white;
            font-weight: 500;
            font-size: 0.9375rem;
            border-radius: 0.5rem;
            width: 100%;
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            border: none;
        }

        @media (min-width: 1024px) {
            .publish-btn {
                font-size: 1rem;
                width: 10.625rem;
            }
        }

        .vector-icon {
            width: 1rem;
            height: 1rem;
        }

        /* Submitted Offers Section */
        .filter-btn {
            background-color: white;
            color: #344054;
            font-weight: 500;
            font-size: 0.9375rem;
            border-radius: 0.5rem;
            border: 1px solid #344054;
            padding: 0.5rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            margin-left: auto;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 1024px) {
            .filter-btn {
                font-size: 1rem;
                width: 10.625rem;
            }
        }

        .files-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            padding: 0.5rem 0;
        }

        @media (min-width: 640px) {
            .files-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .files-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .file-card {
            background-color: white;
            border: 1px solid #1E90FF;
            border-radius: 0.5rem;
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .file-header {
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .file-title {
            color: #344054;
            font-weight: bold;
            font-size: 0.875rem;
        }

        .file-size {
            color: #6B7280;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .open-btn {
            background-color: #F9F5FF;
            color: #3B82F6;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
            cursor: pointer;
            border: none;
            margin-top: 1.5rem;
        }

        .upload-icon {
            width: 1rem;
            height: 1rem;
        }

        .status-section {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .status-title {
            color: black;
            font-weight: 500;
            font-size: 0.9375rem;
            text-align: center;
        }

        @media (min-width: 1024px) {
            .status-title {
                font-size: 1rem;
            }
        }

        .status-badge {
            background-color: #E6F1FF;
            color: #4361EE;
            font-weight: 500;
            font-size: 0.9375rem;
            border-radius: 1.25rem;
            padding: 0.25rem;
            text-align: center;
        }

        @media (min-width: 1024px) {
            .status-badge {
                font-size: 1rem;
                width: 10.625rem;
            }
        }

        .edit-btn {
            background-color: rgba(16, 24, 40, 0.05);
            color: #1E90FF;
            font-weight: 500;
            font-size: 0.9375rem;
            border-radius: 0.5rem;
            width: 100%;
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            border: none;
        }

        @media (min-width: 1024px) {
            .edit-btn {
                font-size: 1rem;
                width: 10.625rem;
            }
        }

        /* Projects Section */
        .projects-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-box {
            background-color: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
            padding: 1rem;
            max-width: 28rem;
            width: 100%;
        }

        .info-title {
            color: #374151;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .info-text {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .update-btn {
            background-color: #4361EE;
            color: white;
            font-weight: 500;
            font-size: 0.9375rem;
            border-radius: 0.5rem;
            width: 100%;
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            border: none;
        }

        @media (min-width: 1024px) {
            .update-btn {
                font-size: 1rem;
                width: 11.875rem;
            }
        }

        .add-btn {
            background-color: #F4F1FD;
            color: black;
            font-weight: 600;
            font-size: 0.9375rem;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            border: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .form-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .form-select {
            border: 1px solid #D1D5DB;
            border-radius: 0.5rem;
            padding: 0.5rem;
            color: #374151;
            font-size: 0.875rem;
        }

        .form-select:focus {
            outline: none;
            border-color: #3B82F6;
        }

        /* Hidden sections */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
@endsection
@section('content')



    <div class="container">
        <div class="tabs-container">
            <div class="main-content">
                <!-- Tabs Navigation -->
                <div class="tabs-nav">
                    <button class="tab-btn active" data-tab="browse">
                        {{ __('tabs.browse_projects') }}
                        <span class="tab-indicator"></span>
                    </button>
                    <button class="tab-btn" data-tab="submitted">
                        {{ __('tabs.my_submitted_offers') }}
                        <span class="tab-indicator"></span>
                    </button>
                    <button class="tab-btn" data-tab="documents">
                        {{ __('tabs.documents_contracts') }}
                        <span class="tab-indicator"></span>
                    </button>
                    <button class="tab-btn" data-tab="conversations">
                        {{ __('tabs.conversations') }}
                        <span class="tab-indicator"></span>
                    </button>
                    <button class="tab-btn" data-tab="projects">
                        {{ __('tabs.my_projects') }}
                        <span class="tab-indicator"></span>
                    </button>
                </div>

                <!-- Tabs Content -->
                <div class="tabs-content">
                    <!-- Browse Projects Tab -->
                    <div id="browse" class="tab-content active">
                        <div class="projects-list">
                            <!-- Project 1 -->
                            <div class="project-card">
                                <div class="project-grid">
                                    <div class="profile-section">
                                        <img src="https://example.com/avatar.jpg" alt="{{ __('alt.avatar') }}"
                                            class="avatar">
                                        <div class="flex justify-center space-x-1 rtl:space-x-reverse mb-1">
                                            <img src="https://example.com/star-icon.svg" alt="{{ __('alt.star') }}">
                                        </div>
                                        <div class="office-name">{{ __('labels.office_name') }}</div>
                                    </div>

                                    <div class="details-section">
                                        <div class="file-info">
                                            <img src="https://example.com/file-icon.svg" alt="{{ __('alt.file') }}"
                                                class="file-icon">
                                            <span>{{ __('offers.content') }}</span>
                                        </div>
                                        <button class="browse-btn">
                                            <span>{{ __('buttons.browse_project') }}</span>
                                            <img src="https://example.com/download-icon.svg" alt="{{ __('alt.download') }}"
                                                class="download-icon">
                                        </button>
                                    </div>

                                    <div class="actions-section">
                                        <button class="publish-btn">
                                            <span>{{ __('buttons.publish_project') }}</span>
                                            <img src="https://example.com/vector-icon.svg" alt="{{ __('alt.vector') }}"
                                                class="vector-icon">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat for Project 2, 3 ... -->
                        </div>
                    </div>

                    <!-- Submitted Offers Tab -->
                    <div id="submitted" class="tab-content">
                        <div class="projects-list">
                            <button class="filter-btn">
                                <img src="https://example.com/filter-icon.svg" alt="{{ __('alt.filter') }}">
                                <span>{{ __('buttons.publish_project') }}</span>
                            </button>

                            <!-- Project 1 -->
                            <div class="project-card">
                                <div class="project-grid">
                                    <div class="profile-section">
                                        <img src="https://example.com/avatar.jpg" alt="{{ __('alt.avatar') }}"
                                            class="avatar">
                                        <div class="flex justify-center space-x-1 rtl:space-x-reverse mb-1">
                                            <img src="https://example.com/star-icon.svg" alt="{{ __('alt.star') }}">
                                        </div>
                                        <div class="office-name">{{ __('labels.office_name') }}</div>
                                    </div>

                                    <div class="details-section">
                                        <div class="file-info">
                                            <img src="https://example.com/file-icon.svg" alt="{{ __('alt.file') }}"
                                                class="file-icon">
                                            <span>{{ __('offers.content') }}</span>
                                        </div>

                                        <div class="files-grid">
                                            <!-- File 1 -->
                                            <div class="file-card">
                                                <div class="file-header">
                                                    <img src="https://example.com/file-icon.svg" alt="{{ __('alt.file') }}"
                                                        class="file-icon">
                                                    <div>
                                                        <div class="file-title">
                                                            {{ __('files.technical_requirements') }}</div>
                                                        <p class="file-size">200 KB</p>
                                                    </div>
                                                </div>
                                                <button class="open-btn">
                                                    <span>{{ __('buttons.open') }}</span>
                                                    <img src="https://example.com/upload-icon.svg"
                                                        alt="{{ __('alt.upload') }}" class="upload-icon">
                                                </button>
                                            </div>
                                            <!-- Repeat for File 2, 3 ... -->
                                        </div>
                                    </div>

                                    <div class="actions-section">
                                        <div class="status-title">{{ __('labels.order_status') }}</div>
                                        <div class="status-badge">{{ __('labels.status') }}</div>
                                        <button class="edit-btn">
                                            <span>{{ __('buttons.browse_project') }}</span>
                                        </button>
                                        <button class="publish-btn">
                                            <span>{{ __('buttons.edit_display') }}</span>
                                            <img src="https://example.com/vector-icon.svg" alt="{{ __('alt.vector') }}"
                                                class="vector-icon">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat for Project 2 ... -->
                        </div>
                    </div>

                    <!-- Documents Tab -->
                    <div id="documents" class="tab-content">
                        <div style="padding: 2rem; text-align: center; font-size: 1.5rem;">
                            {{ __('tabs.documents') }}
                        </div>
                    </div>

                    <!-- Conversations Tab -->
                    <div id="conversations" class="tab-content">
                        <div style="padding: 2rem; text-align: center; font-size: 1.5rem;">
                            {{ __('tabs.chat') }}
                        </div>
                    </div>

                    <!-- Projects Tab -->
                    <div id="projects" class="tab-content">
                        <div class="projects-content">
                            <div class="flex flex-col lg:flex-row items-start justify-between gap-4">
                                <div class="info-box">
                                    <h2 class="info-title">{{ __('projects.add_specific_owner') }}</h2>
                                    <p class="info-text">{{ __('projects.add_owner_hint') }}</p>
                                </div>

                                <button class="update-btn">
                                    <span>{{ __('buttons.update_project_status') }}</span>
                                    <img src="https://example.com/vector-icon.svg" alt="{{ __('alt.vector') }}"
                                        class="vector-icon">
                                </button>
                            </div>

                            <div class="flex justify-start">
                                <button class="add-btn">
                                    + {{ __('buttons.add_another_item') }}
                                </button>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">{{ __('projects.structure') }}</label>
                                    <select class="form-select">
                                        <option>{{ __('labels.status') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('projects.finishes') }}</label>
                                    <select class="form-select">
                                        <option>{{ __('labels.status') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('projects.basics') }}</label>
                                    <select class="form-select">
                                        <option>{{ __('labels.status') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('projects.finishes') }}</label>
                                    <select class="form-select">
                                        <option>{{ __('labels.status') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            // Tab switching functionality
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked button
                    button.classList.add('active');

                    // Show corresponding content
                    const tabId = button.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        </script>
    @endsection
