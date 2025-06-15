<footer class="footer">
    <div class="footer-top">
        <div class="footer-section">
            <div class="footer-contact">
                <img src="https://via.placeholder.com/16x16?text=PH" alt="{{ __('messages.footer.phone_icon_alt') }}">
                <p>971503665155+</p>
            </div>
            <div class="footer-contact">
                <img src="https://via.placeholder.com/16x16?text=EM" alt="{{ __('messages.footer.email_icon_alt') }}">
                <a href="mailto:contactus@inshaat.ae">contactus@inshaat.ae</a>
            </div>
        </div>

        <div class="footer-section">
            <p class="footer-title">{{ __('messages.footer.inspired_designs') }}</p>
            <p class="footer-title">{{ __('messages.footer.calculate') }}</p>
        </div>

        <div class="footer-section">
            <p class="footer-title">{{ __('messages.footer.support') }}</p>
            <p class="footer-title" id="footerLanguageToggle">{{ __('messages.header.arabic') }}</p>
        </div>

        <div class="footer-section">
            <p class="footer-title">{{ __('messages.footer.opinions') }}</p>
            <p class="footer-title">{{ __('messages.footer.about') }}</p>
        </div>

        <div class="footer-section newsletter">
            <p style="font-weight: 700; color: #0B090A; font-size: 1.2rem; margin-bottom: 1rem; text-align: right;">
                {{ __('messages.footer.newsletter_title') }}</p>
            <div class="newsletter-input">
                <input type="text" placeholder="{{ __('messages.footer.email_placeholder') }}">
                <img src="https://via.placeholder.com/16x16?text=S" alt="{{ __('messages.footer.subscribe_icon_alt') }}">
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <div>
                <p>{{ __('messages.footer.copyright') }}</p>
            </div>
            <div style="display: flex; gap: 2rem;">
                <p>{{ __('messages.footer.use_policy') }}</p>
                <p>{{ __('messages.footer.privacy_policy') }}</p>
            </div>
        </div>
    </div>
</footer>
<script>
    // Mobile navigation toggle
    const menuButton = document.getElementById('menuButton');
    const closeButton = document.getElementById('closeButton');
    const mobileNav = document.getElementById('mobileNav');

    menuButton.addEventListener('click', () => {
        mobileNav.classList.add('open');
    });

    closeButton.addEventListener('click', () => {
        mobileNav.classList.remove('open');
    });

    // Language toggle
    const languageToggle = document.getElementById('languageToggle');
    const footerLanguageToggle = document.getElementById('footerLanguageToggle');

    languageToggle.addEventListener('click', () => {
        if (languageToggle.textContent === '{{ __('messages.header.arabic') }}') {
            languageToggle.textContent = '{{ __('messages.header.english') }}';
            footerLanguageToggle.textContent = '{{ __('messages.header.english') }}';
        } else {
            languageToggle.textContent = '{{ __('messages.header.arabic') }}';
            footerLanguageToggle.textContent = '{{ __('messages.header.arabic') }}';
        }
    });

    footerLanguageToggle.addEventListener('click', () => {
        if (footerLanguageToggle.textContent === '{{ __('messages.header.arabic') }}') {
            footerLanguageToggle.textContent = '{{ __('messages.header.english') }}';
            languageToggle.textContent = '{{ __('messages.header.english') }}';
        } else {
            footerLanguageToggle.textContent = '{{ __('messages.header.arabic') }}';
            languageToggle.textContent = '{{ __('messages.header.arabic') }}';
        }
    });

    // Login link
    document.getElementById('loginLink').addEventListener('click', () => {
        window.location.href = '/auth/login';
    });

    // Scroll effect for header
    window.addEventListener('scroll', () => {
        const header = document.getElementById('mainHeader');
        if (window.scrollY >= 90) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>
