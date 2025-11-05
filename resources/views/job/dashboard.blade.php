@extends('layouts.jobseeker')

@section('title', 'Job Seeker Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Hello, Job Seeker 👋</h1>

        <div id="job-feed" class="space-y-6">


    </div>

    <div id="loading" class="text-center text-gray-500 py-4">Loading jobs...</div>
        <div id="no-more" class="text-center text-gray-400 py-4 hidden">🎉 You've reached the end of jobs!</div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let page = 1;
            let isLoading = false;
            let lastPage = false;
            const loadingElement = document.getElementById('loading');
            const noMoreElement = document.getElementById('no-more');
            const jobFeed = document.getElementById('job-feed');

            async function loadJobs() {
                if (isLoading || lastPage) return;

                isLoading = true;
                loadingElement.classList.remove('hidden');

                try {
                    const res = await fetch(`{{ route('jobseeker.getJobs') }}?page=${page}`);
                    const data = await res.json();



                    if (!data.data || data.data.length === 0) {
                        lastPage = true;
                        loadingElement.classList.add('hidden');
                        noMoreElement.classList.remove('hidden');
                        return;
                    }

                    data.data.forEach(job => {
                        const div = document.createElement('div');
                        div.classList.add('bg-white', 'rounded-xl', 'shadow-md', 'hover:shadow-lg', 'transition', 'p-6');
                        div.innerHTML = `
                            <div class="flex justify-between items-center mb-3">
                                <p class="text-sm text-gray-500">
                                    Posted by <span class="font-semibold text-indigo-600">${job.user?.name ?? 'Unknown'}</span>
                                </p>
                                <p class="text-xs text-gray-400">${new Date(job.created_at).toLocaleDateString()}</p>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">${job.title}</h2>
                            <div class="grid md:grid-cols-2 gap-4 text-gray-700 mb-4">
                                <div>
                                    <p><span class="font-medium">Requirements:</span> ${job.description ?? 'N/A'}</p>
                                    <p><span class="font-medium">Skills:</span> ${job.skills ?? 'N/A'}</p>
                                </div>
                                <div>
                                    <p><span class="font-medium">Qualification:</span> ${job.qualification ?? 'N/A'}</p>
                                    <p><span class="font-medium">Experience:</span> ${job.experience ?? 'N/A'}</p>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <form method="POST" action="/seeker/apply/${job.id}">
                                    @csrf
                        <button type="submit"
                            class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                            Apply
                        </button>
                    </form>
                </div>
`;
                        jobFeed.appendChild(div);
                    });

                    page++;

                    if (page > data.last_page) {
                        lastPage = true;
                        noMoreElement.classList.remove('hidden');
                    }

                } catch (err) {
                    console.error('Error loading jobs:', err);
                } finally {
                    isLoading = false;
                    loadingElement.classList.add('hidden');
                }
            }
            loadJobs();
            const wrapper=document.getElementById('mainDiv');

            // Simple scroll detection that definitely works
            wrapper.addEventListener('scroll', function() {
                if (wrapper.scrollTop + wrapper.clientHeight >= wrapper.scrollHeight - 50) {
                    loadJobs();
                }

                });


        });
    </script>
@endsection
