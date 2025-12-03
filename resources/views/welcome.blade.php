<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Manager - Organize Your Life</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen">
        <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav class="flex items-center justify-between">
                <div class="text-xl font-semibold">Task Manager</div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 text-sm border border-[#19140035] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b] rounded-sm">
                            My Tasks
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="text-center mb-16">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">
                    Stay Organized.<br>
                    Get Things Done.
                </h1>
                <p class="text-xl text-[#706f6c] dark:text-[#A1A09A] mb-8 max-w-2xl mx-auto">
                    A simple and elegant task management application to help you organize your tasks, set priorities, and track your progress.
                </p>
                @guest
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white font-medium text-lg">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="px-6 py-3 border border-[#19140035] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b] rounded-sm font-medium text-lg">
                            Sign In
                        </a>
                    </div>
                @else
                    <a href="{{ route('tasks.index') }}" class="inline-block px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white font-medium text-lg">
                        Go to My Tasks
                    </a>
                @endguest
            </div>

            <div class="grid md:grid-cols-3 gap-8 mt-20">
                <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-6">
                    <div class="w-12 h-12 bg-[#f53003] dark:bg-[#FF4433] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Create Tasks</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">
                        Easily create and organize your tasks with titles, descriptions, and due dates.
                    </p>
                </div>

                <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-6">
                    <div class="w-12 h-12 bg-[#f53003] dark:bg-[#FF4433] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Set Priorities</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">
                        Mark tasks as high, medium, or low priority to focus on what matters most.
                    </p>
                </div>

                <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-6">
                    <div class="w-12 h-12 bg-[#f53003] dark:bg-[#FF4433] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Track Progress</h3>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">
                        Mark tasks as complete and see your progress at a glance.
                    </p>
                </div>
            </div>
        </main>

        <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-20 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
            <p class="text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                © {{ date('Y') }} Task Manager. Built with Laravel.
            </p>
        </footer>
    </body>
</html>
