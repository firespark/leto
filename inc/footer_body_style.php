    <!-- Стилі для body -->
    <style>
        .lock body {
            overflow: hidden;
            touch-action: none;
            overscroll-behavior: none;
        }

        .loading body {
            opacity: 0;
            visibility: hidden;
        }

        .loaded body {
            transition: opacity 0.5s ease 0s;
            opacity: 1;
            visibility: visible;
        }
    </style>