<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('custom-css')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .pull-to-refresh {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
        }

        .pull-to-refresh .fa-spinner {
            font-size: 30px;
            /* Adjust the icon size as desired */
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @stack('livewire-style')
</head>

<body>
    @include('layouts.header')
    <div class="content-container" id="contentContainer">
        @include('sweetalert::alert')
        @yield('content')
    </div>
    @include('layouts.footer')
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{-- <script src="{{ asset('js/popper.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('custom-js')
    <script>
        let startY, lastY;
        const contentContainer = document.getElementById('contentContainer');
        const pullToRefreshIcon = '<div class="pull-to-refresh"><i class="fas fa-spinner"></i></div>';

        contentContainer.addEventListener('touchstart', (event) => {
            const touch = event.touches[0];
            startY = touch.clientY;
            lastY = startY;
        });

        contentContainer.addEventListener('touchmove', (event) => {
            const touch = event.touches[0];
            lastY = touch.clientY;
        });

        contentContainer.addEventListener('touchend', (event) => {
            const touch = event.changedTouches[0];
            const deltaY = lastY - startY;
            if (deltaY > 100) {
                const refreshIconElement = document.createElement('div');
                refreshIconElement.innerHTML = pullToRefreshIcon;
                contentContainer.prepend(refreshIconElement);

                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        });
    </script>
    @stack('livewire-script')
</body>

</html>
