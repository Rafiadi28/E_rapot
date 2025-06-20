<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapot - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-200 overflow-y-auto" :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'lg:translate-x-0': true}">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <i class="fas fa-book-open text-blue-600 text-2xl mr-3"></i>
                    <h2 class="text-2xl font-bold text-gray-800">E-Rapot</h2>
                </div>
                <p class="text-sm text-gray-500 mt-1">Sistem Informasi Rapor</p>
            </div>
            <nav class="mt-4 px-2">
                @include('layouts.navigation')
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="lg:ml-64 min-h-screen transition-all duration-200">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-40">
                <div class="px-4 py-4 flex justify-between items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div class="flex items-center">
                        @auth
                            <div class="flex items-center mr-4">
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white mr-2">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm px-3 py-1 rounded bg-red-50 text-red-600 hover:bg-red-100 transition duration-150 ease-in-out">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white p-4 text-center text-gray-500 text-sm border-t">
                &copy; {{ date('Y') }} E-Rapot - Sistem Informasi Rapor
            </footer>

        </div>
    </div>
    
    <!-- Scripts Section -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>