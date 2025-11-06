@extends('layouts.jobseeker') {{-- use your jobseeker layout --}}
@section('title', 'My Profile')
@section('page_title',"Profile")


@section('content')
    <a href="/jobseeker/edit"
       class="inline-block bg-indigo-600 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-indigo-700 ml-4 transition">
        Edit
    </a>

    <div class="flex flex-col md:flex-row gap-6 p-6 bg-gray-50 min-h-screen">


        {{-- LEFT PANEL --}}
        <div class="md:w-1/3 bg-white rounded-xl shadow p-6">
            {{-- Profile Header --}}
            <div class="flex flex-col items-center text-center mb-6">
                <img src="{{Auth::user()->image ?asset("/storage/".Auth::user()->image):asset('/storage/Images/default.jpg') }}" alt="Profile Photo"
                     class="w-40 h-40 rounded-full mb-3 object-cover">
                <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
            </div>

            {{-- Contact & Address --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Contact Details</h3>
                <p><span class="font-medium">Phone:</span> {{ $profile->user->phone ?? 'Not provided' }}</p>
                <p><span class="font-medium">Address:</span> {{ $profile->address ?? 'Not provided' }}</p>
            </div>

            {{-- Experience --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Experience</h3>
                @if(!empty($profile->experience))
                    <ul class="list-disc pl-5 space-y-1 text-gray-700">
                        @foreach(explode(',', $profile->experience) as $exp)
                            <li>{{ trim($exp) }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No experience listed</p>
                @endif
            </div>

            {{-- Qualification --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Qualifications</h3>
                @if(!empty($profile->qualification))
                    <ul class="list-disc pl-5 space-y-1 text-gray-700">
                        @foreach(explode(',', $profile->qualification) as $qual)
                            <li>{{ trim($qual) }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No qualifications listed</p>
                @endif
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="md:w-2/3 bg-white rounded-xl shadow p-6 flex flex-col">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Curriculum Vitae (CV)</h2>

            @if(!empty($profile->cv))
                <iframe src="{{ asset('storage/' . $profile->cv) }}"
                        class="w-full h-full border rounded-lg"
                        frameborder="0">
                </iframe>
            @else
                <div class="flex items-center justify-center h-full text-gray-500">
                    <p>No CV uploaded yet</p>
                </div>
            @endif
        </div>
    </div>
@endsection
