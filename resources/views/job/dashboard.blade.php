@extends('layouts.jobseeker')

@section('title', 'Job Seeker Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Hello, Job Seeker 👋</h1>
    <div class="flex justify-center mb-6">
        <div class="relative w-full max-w-md">
            <input
                type="text"
                id="searchInput"
                class="w-full py-2.5 pl-10 pr-4 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                placeholder="Search jobs..."
            >

{{--            not deleting this button cause I loved the stype of it and might be needed in other apps--}}
{{--            <button--}}
{{--                id="search-btn"--}}
{{--                class="absolute right-2 top-1/2 -translate-y-1/2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1.5 rounded-full shadow-md transition duration-200"--}}
{{--            >--}}
{{--                🔍--}}
{{--            </button>--}}
        </div>
    </div>
        <div id="job-feed" class="space-y-6">
    </div>

    <div id="loading" class="text-center text-gray-500 py-4">Loading jobs...</div>
        <div id="no-more" class="text-center text-gray-400 py-4 hidden">🎉 You've reached the end of jobs!</div>
{{--    adding sweet alert--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let token = `{{ csrf_token() }}`;
        let page = 1;
        let isLoading = false;
        let lastPage = false;
        let debounceTimer = null;
        let searchMode = false; // 🔵 NEW — track if user is searching

        const jobFeed = document.getElementById('job-feed');
        const searchInput = document.getElementById('searchInput');
        const loadingElement = document.getElementById('loading');
        const noMoreElement = document.getElementById('no-more');
        const wrapper = document.getElementById('mainDiv');

        // ✅ Debounce helper
        function debounce(func, delay = 400) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(func, delay);
        }

        // ✅ Initial paginated loading
        async function loadJobs() {
            if (isLoading || lastPage || searchMode) return; // prevent loading during search

            isLoading = true;
            loadingElement.classList.remove('hidden');

            try {
                const res = await fetch(`{{ route('jobseeker.getJobs') }}?page=${page}`);
                const data = await res.json();

                if (!data.data || data.data.length === 0) {
                    lastPage = true;
                    noMoreElement.classList.remove('hidden');
                    return;
                }

                renderJobs(data.data, true);
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

        // ✅ Search handler (on typing)
        searchInput.addEventListener('input', () => {
            debounce(async () => {
                const query = searchInput.value.trim();

                if (query === '') {
                    // 🔄 Reset to pagination mode
                    searchMode = false;
                    jobFeed.innerHTML = '';
                    page = 1;
                    lastPage = false;
                    loadJobs();
                    return;
                }

                // 🔵 Enter search mode
                searchMode = true;
                jobFeed.innerHTML = '<p class="text-gray-400 text-center">Searching...</p>';

                try {
                    const response = await fetch(`{{ route('jobs.search') }}?search=${encodeURIComponent(query)}`);
                    if (!response.ok) throw new Error('Failed to fetch search results');
                    const data = await response.json();

                    if (!data || data.length === 0) {
                        jobFeed.innerHTML = '<p class="text-gray-500 text-center">No jobs found for your search.</p>';
                        return;
                    }

                    renderJobs(data, false);
                } catch (error) {
                    console.error(error);
                    jobFeed.innerHTML = '<p class="text-red-500 text-center">Error loading search results.</p>';
                }
            }, 400);
        });

        // ✅ Infinite scroll (only for pagination)
        wrapper.addEventListener('scroll', () => {
            if (!searchMode && wrapper.scrollTop + wrapper.clientHeight >= wrapper.scrollHeight - 50) {
                loadJobs();
            }
        });

        // ✅ Render job cards
        function renderJobs(jobs, append = false) {
            if (!append) jobFeed.innerHTML = ''; // clear only for search

            jobs.forEach(job => {
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
                <button type="submit"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-indigo-700 transition"
                    onclick="jobApplication(${job.job_id})">
                    Apply
                </button>
            </div>
        `;
                jobFeed.appendChild(div);
            });
        }

        // ✅ Job apply (SweetAlert confirmation)
        async function jobApplication(id) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to apply for this job?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, apply',
                cancelButtonText: 'Cancel'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch(`{{ route('jobseeker.application.apply') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ post_id: id })
                    });

                    const data = await response.json();
                    Swal.fire(response.ok ? 'Applied!' : 'Error', data.message, response.ok ? 'success' : 'error');
                } catch (error) {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            }
        }

        // ✅ Initial load
        document.addEventListener('DOMContentLoaded', loadJobs);
    </script>


@endsection
