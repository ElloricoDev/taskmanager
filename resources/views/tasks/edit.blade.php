@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('tasks.index') }}" class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Tasks
        </a>
    </div>

    <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-8">
        <h1 class="text-2xl font-semibold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">Edit Task</h1>
        
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                    class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="priority" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Priority</label>
                    <select name="priority" id="priority"
                        class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
                        <option value="1" {{ old('priority', $task->priority) == 1 ? 'selected' : '' }}>Low</option>
                        <option value="2" {{ old('priority', $task->priority) == 2 ? 'selected' : '' }}>Medium</option>
                        <option value="3" {{ old('priority', $task->priority) == 3 ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433]">
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="completed" value="1" {{ old('completed', $task->completed) ? 'checked' : '' }}
                        class="rounded border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <span class="ml-2 text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Mark as completed</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white font-medium transition-colors">
                    Update Task
                </button>
                <a href="{{ route('tasks.index') }}" class="px-6 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm hover:border-[#1915014a] dark:hover:border-[#62605b] text-[#1b1b18] dark:text-[#EDEDEC]">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

