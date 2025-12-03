@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto mt-12">
    <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-8 shadow-sm">
        <h1 class="text-2xl font-semibold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">Register</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white font-medium transition-colors">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            Already have an account? <a href="{{ route('login') }}" class="text-[#f53003] dark:text-[#FF4433] hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection

