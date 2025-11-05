@extends('layouts.employer')

@section('title', 'Post a Job')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow " style="padding: 10px">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700">Post a New Job</h2>

        <form method="POST" action="{{ route('emp.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Job Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. Senior Laravel Developer">
                @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Qualification --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. Bachelor in Computer Science">
                @error('qualification')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Skills (comma separated)</label>
                <input type="text" name="skills" value="{{ old('skills') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. PHP, Laravel, MySQL">
                @error('skills')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Experience</label>
                <input type="text" name="experience" value="{{ old('experience') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. 2+ years">
                @error('experience')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Salary</label>
                <input type="text" name="salary" value="{{ old('salary') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. 50000 - 70000">
                @error('salary')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. 50000 - 70000">
                @error('location')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Type</label>
                <input type="text" name="type" value="{{ old('type') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. 50000 - 70000">
                @error('type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Description</label>
                <input type="text" name="description" value="{{ old('salary') }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. 50000 - 70000">
                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition">
                Post Job
            </button>
        </form>
    </div>
@endsection
