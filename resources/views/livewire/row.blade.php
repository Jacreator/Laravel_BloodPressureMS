<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Livewire Datatables</title>
    @livewireStyles
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .btn {
            @apply font-bold py-2 px-4 rounded;
        }

        .btn-blue {
            @apply bg-blue-500 text-white;
        }

        .btn-blue:hover {
            @apply bg-blue-700;
        }

    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="container mx-auto">
        <h1 class="py-2 text-xl text-center">Blood Pressure Recording App using Livewire</h1>
        <div class="flex justify-end">
            <a href="{{ route('export-patient') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-2 px-2 m-1 rounded">Generate Excel</a>
            <a href="{{ route('manage-patient')}}"
                class="bg-transparent hover:bg-blue-500 text-blue-700 text-center font-semibold hover:text-white py-2 px-2 m-1 border border-blue-500 hover:border-transparent rounded">Manage Patient</a>
        </div>

        <div class="py-4">
            <livewire:patient-table />
        </div>
    </div>
</body>
@livewireScripts

</html>
