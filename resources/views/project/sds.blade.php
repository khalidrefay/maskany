@section('js')
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab switching functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.style.display = 'none');

                // Add active class to clicked button and show corresponding content
                button.classList.add('active');
                document.querySelectorAll('.tab-content')[index].style.display = 'block';
            });
        });

        // Offer modal functions
        function openOfferModal() {
            document.getElementById('offer-modal').style.display = 'flex';
        }

        function closeOfferModal() {
            document.getElementById('offer-modal').style.display = 'none';
        }

        // Initialize the first tab as active
        document.querySelector('.tab-button.active').click();
    </script>
    <script>
        // Handle image upload preview
        document.getElementById('upload-area').addEventListener('click', function() {
            document.getElementById('image-input').click();
        });

        document.getElementById('image-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('image-preview');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                    document.querySelector('#upload-area i').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle adding/removing desired locations
        document.getElementById('add-location').addEventListener('click', function() {
            const container = document.getElementById('desired-locations-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
            <input type="text" name="desired_locations[]" class="form-control" placeholder="اكتب الموقع المطلوب" required>
            <button type="button" class="btn btn-outline-danger remove-location">حذف</button>
        `;
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-location')) {
                const container = document.getElementById('desired-locations-container');
                if (container.children.length > 1) {
                    e.target.parentElement.remove();
                } else {
                    alert('يجب أن يكون هناك موقع واحد على الأقل');
                }
            }
        });

        // Initialize map coordinates (you would integrate with your map API)
        function setMapCoordinates(lat, lng) {
            document.getElementById('map_coordinates').value = `${lat},${lng}`;
        }
    </script>
@endsection
