@extends('layouts.jobseeker')

@section('title', 'Complete Profile')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Complete Your Profile</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route("jobseeker.store")}}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md max-w-2xl">
        @csrf
        <!-- Address -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Address</label>
            <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}"
                   class="w-full border border-gray-300 p-2 rounded">
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Qualification -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Qualification</label>
            <input type="text" name="qualification" value="{{ old('qualification', $profile->qualification ?? '') }}"
                   class="w-full border border-gray-300 p-2 rounded">
            @error('qualification') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Experience -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Experience</label>
            <input type="text" name="experience" value="{{ old('experience', $profile->experience ?? '') }}"
                   class="w-full border border-gray-300 p-2 rounded">
            @error('experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Upload CV -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Upload CV</label>
            <input type="file" name="cv" class="w-full" accept=".application/pdf">
            @if(!empty($profile->cv))
                <a href="{{ asset('storage/'.$profile->cv) }}" target="_blank" class="text-indigo-600 underline mt-1 inline-block" >
                    View Uploaded CV
                </a>
            @endif
            @error('cv') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
            Save Profile
        </button>
    </form>
@endsection
