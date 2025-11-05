<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Job Seeker Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 text-gray-800">

{{-- Sidebar + Topbar Layout --}}
<div class="flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md flex flex-col justify-between">
        <div>
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-600">JobSeeker</h1>
            </div>
            <nav class="mt-6">
                <a href="{{route("jobseeker.index")}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 4h12a2 2 0 002-2V9a2 2 0 00-2-2h-3" />
                    </svg>
                    Dashboard
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405M19 13V7a7 7 0 10-14 0v6l-2 2v1h18v-1l-2-2z" />
                    </svg>
                    Notifications
                </a>

                <a href="{{route('/jobseeker/profile')}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Profile
                </a>
            </nav>
        </div>

        {{-- Logout --}}
        <div class="p-6 border-t">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg font-semibold hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Top Bar --}}
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700">@yield('page_title', 'Dashboard')</h2>
            <span class="text-gray-500">Welcome, {{ Auth::user()->name ?? 'User' }}</span>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6 overflow-y-auto" id="mainDiv">
            @yield('content')
        </main>

    </div>
</div>
</body>
</html>
