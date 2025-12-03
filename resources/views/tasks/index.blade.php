@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white font-medium transition-colors">
        + New Task
    </a>
</div>

@if($tasks->isEmpty())
    <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-12 text-center">
        <p class="text-[#706f6c] dark:text-[#A1A09A] text-lg mb-4">No tasks yet. Create your first task!</p>
        <a href="{{ route('tasks.create') }}" class="inline-block px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white font-medium">
            Create Task
        </a>
    </div>
@else
    <div class="space-y-3">
        @foreach($tasks as $task)
            <div class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-4 hover:shadow-md transition-shadow {{ $task->completed ? 'opacity-60' : '' }}">
                <div class="flex items-start gap-4">
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}" class="mt-1">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-5 h-5 rounded border-2 border-[#e3e3e0] dark:border-[#3E3E3A] flex items-center justify-center {{ $task->completed ? 'bg-green-500 border-green-500' : '' }} hover:border-[#f53003] dark:hover:border-[#FF4433] transition-colors">
                            @if($task->completed)
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </button>
                    </form>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-[#1b1b18] dark:text-[#EDEDEC] {{ $task->completed ? 'line-through' : '' }}">
                                    {{ $task->title }}
                                </h3>
                                @if($task->description)
                                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A] {{ $task->completed ? 'line-through' : '' }}">
                                        {{ $task->description }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center gap-4 mt-3 text-xs text-[#706f6c] dark:text-[#A1A09A]">
                                    @if($task->priority)
                                        <span class="px-2 py-1 rounded-sm 
                                            @if($task->priority == 3) bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-200
                                            @elseif($task->priority == 2) bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-200
                                            @else bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200
                                            @endif">
                                            @if($task->priority == 3) High
                                            @elseif($task->priority == 2) Medium
                                            @else Low
                                            @endif
                                        </span>
                                    @endif
                                    
                                    @if($task->due_date)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $task->due_date->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-1 text-sm border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm hover:border-[#1915014a] dark:hover:border-[#62605b] text-[#1b1b18] dark:text-[#EDEDEC]">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-sm border border-red-200 dark:border-red-800 rounded-sm hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

