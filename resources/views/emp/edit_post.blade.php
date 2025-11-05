@extends('layouts.employer')

@section('title', 'Edit Job')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow" style="padding: 10px">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700">Edit Job</h2>

        <form method="POST" action="{{ route('emp.update', $job->job_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Qualification --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification', $job->qualification) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('qualification')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Skills --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Skills (comma separated)</label>
                <input type="text" name="skills" value="{{ old('skills', $job->skills) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('skills')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Experience --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Experience</label>
                <input type="text" name="experience" value="{{ old('experience', $job->experience) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('experience')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Salary --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Salary</label>
                <input type="text" name="salary" value="{{ old('salary', $job->salary) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('salary')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Location --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('location')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Type / Category --}}
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Type</label>
                <input type="text" name="type" value="{{ old('category', $job->type) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('category')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $job->description) }}</textarea>
                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('emp.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg transition">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition">
                    Update Job
                </button>
            </div>
        </form>
    </div>
@endsection
