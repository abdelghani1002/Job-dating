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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tom-select style -->
    {{-- <link href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Insert the blade containing the TinyMCE configuration and source script -->
    {{-- <x-head.tinymce-config/> --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Page footer -->
        @include("layouts.footer")
    </div>

    <!-- Include TomSelect (without jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <!-- Include jQuery separately, after TomSelect -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        //
        function confirmDelete(event) {
            // var confirmation = confirm(`Are you sure you want to delete it!`);
            // return confirmation;
            event.preventDefault();
            Swal.fire({
                title: "Are you sure you want to delete it!",
                icon: "question",
                iconHtml: "?",
                iconColor: "red",
                confirmButtonText: "yes",
                confirmButtonColor: "red",
                cancelButtonText: "no",
                showCancelButton: true,
                showCloseButton: true
            })
            .then((res)=>{
                if(res.isConfirmed){
                    event.target.submit();
                }
            });
            return false;
        }

        // Initialize TomSelect
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#select-skill', {
                maxItems: 50,
            });

            new TomSelect('#select-partener', {
                maxItems: 50,
            });
        });
        // alert session message
        let alert = document.querySelector(".alert");
        if (alert) {
            let icon = alert.getAttribute("data-icon");
            let title = alert.getAttribute("data-title");
            let text = alert.textContent;
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: 1500,
            });
            alert.classList.add("hidden");
        }
    </script>
</body>

</html>
