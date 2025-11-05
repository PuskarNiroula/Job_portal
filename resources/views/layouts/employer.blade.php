<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Employer Portal</title>
    @vite('resources/css/app.css')

    <style>
        /* Smooth fade for sidebar overlay */
        .overlay {
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(3px);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<!-- Sidebar Overlay (mobile) -->
<div id="overlay" class="overlay hidden fixed inset-0 z-30 md:hidden"></div>

<div class="flex h-screen">
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Top section -->
    <div class="p-6 space-y-8 ">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-indigo-600 tracking-tight">
                Job<span class="text-gray-700">Portal</span>
            </h1>
            <button id="closeSidebar" class="md:hidden text-gray-500 hover:text-gray-800">
                ✕
            </button>
        </div>

        <nav class="space-y-1">
            <a href="{{route("emp.index")}}"
               class="flex items-center px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 6h6m-6 6h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{route("emp.create")}}"
               class="flex items-center px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                Post a Job
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                </svg>
                My Jobs
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.635 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Profile
            </a>
        </nav>
    </div>

    <div class="p-6 border-t border-gray-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-semibold transition">
                Logout
            </button>
        </form>
    </div>
</aside>

<div class="flex-1 flex flex-col" style="margin-left:28vh">

    <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center space-x-3">
            <button id="openSidebar" class="md:hidden text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
            <h1 class="text-lg font-semibold">@yield('title', 'Dashboard')</h1>
        </div>

        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-500">Welcome, {{ Auth::user()->name ?? 'Employer' }}</span>
            <img
                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'E') }}&background=4F46E5&color=fff"
                class="w-9 h-9 rounded-full border border-indigo-200 shadow-sm" alt="avatar">
        </div>
    </header>

    <!-- Page Body -->
    <main class="flex-1 p-6 md:p-10">
        @yield('content')
    </main>


    <footer class="px-6 py-4 border-t text-sm text-gray-500 text-center">
        © {{ date('Y') }} JobPortal — Built with ❤️ for employers.
    </footer>
</div>

</div>
<!-- Sidebar toggle script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const openSidebar = document.getElementById('openSidebar');
    const closeSidebar = document.getElementById('closeSidebar');

    openSidebar?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });

    closeSidebar?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>


</body>
</html>
