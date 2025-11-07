@extends('layouts.employer')

@section('title', 'Job Applications')

@section('content')
    <div class="mt-8 bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Recent Job Posts</h2><div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-indigo-50 border-b">
                    <th class="p-3 text-sm text-gray-600 font-semibold">SN</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Name</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Qualification</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Experience</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Action</th>
                </tr>
                </thead>
                <tbody id="jobs-body">
                @foreach($applicants as $applicant)
                    @php
                        $exps=explode(',',$applicant->user->jobSeekerProfile->experience)
                    @endphp

                    <tr>
                        <td class="p-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="p-3 text-sm text-gray-700">{{ $applicant->user->name }}</td>

                        <td class="p-3 text-sm text-gray-700">{{ $applicant->user->jobSeekerProfile->qualification }}</td>

                        <td class="p-3 text-sm text-gray-700">
                            @foreach($exps as $exp)
                                <span class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded-md text-xs mr-1">
                    {{ trim($exp) }}

                </span>
                                <br/>
                            @endforeach
                        </td>


                        <td>
                            @if($applicant->status=="accepted")
                        <p>Accepted</p>

                        @elseif($applicant->status=="rejected")
                            <p>Rejected</p>

                            @else
                            <a class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition" href="/employer/approve/{{ $applicant->id }}">
                                Approve
                            </a>

                            <a class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition" href="/employer/reject/{{ $applicant->id }}">
                                Reject
                            </a>

                            <a class="inline-block bg-purple-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-purple-600 transition" href="">
                                Download CV
                            </a>
                        </td>
                    </tr>

                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
