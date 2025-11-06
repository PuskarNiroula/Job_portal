@extends('layouts.jobseeker')

@section('title', 'Complete Profile')
@section('page_title',"Update Profile")

@section('content')
    <div class="min-h-screen bg-gray-50 flex justify-center py-10 px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">
                Complete Your Profile
            </h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('jobseeker.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Profile Photo --}}
                <div class="flex flex-col items-center mb-4">
                        <label for="image" class="relative cursor-pointer">
                            <img id="preview"
                                 src="{{ !empty(Auth::user()->image) ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}"
                                 class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-sm hover:opacity-80 transition"
                                 alt="Profile Photo">
                            <input type="file" name="image" id="image" class="hidden" accept="image/*">
                        </label>
                        <p class="text-sm text-gray-500 mt-2">Click image to change</p>
                        @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                </div>

                {{-- Name & Phone --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}"
                               class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}"
                               class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Address --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}"
                           class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Experience & Qualification --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Experience</label>
                        <textarea name="experience" rows="3"
                                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('experience', $profile->experience ?? '') }}</textarea>
                        @error('experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Qualification</label>
                        <textarea name="qualification" rows="3"
                                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('qualification', $profile->qualification ?? '') }}</textarea>
                        @error('qualification') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Upload CV --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Upload CV (PDF)</label>
                    <span class="text-sm text-red-500">Max file size: 2MB  (Leave empty if you dont want to update cv)</span>
                    <input type="file" name="cv" accept="application/pdf"
                           class="block w-full text-gray-700 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
                    @if(!empty($profile->cv))
                        <a href="{{ asset('storage/'.$profile->cv) }}" target="_blank"
                           class="text-indigo-600 underline mt-2 inline-block hover:text-indigo-800">
                            View Uploaded CV
                        </a>
                    @endif
                    @error('cv') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-center pt-4">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow">
                        Save Profile
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
