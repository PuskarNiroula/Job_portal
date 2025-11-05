@extends('layouts.employer')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-gray-500 text-sm font-medium">Total Jobs</h2>
            <p class="text-3xl font-semibold text-indigo-600 mt-1">{{ $totalJobs ?? 0 }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-gray-500 text-sm font-medium">Applications</h2>
            <p class="text-3xl font-semibold text-indigo-600 mt-1">{{ $applications ?? 0 }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-gray-500 text-sm font-medium">Pending Approvals</h2>
            <p class="text-3xl font-semibold text-indigo-600 mt-1">{{ $pending ?? 0 }}</p>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Recent Job Posts</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-indigo-50 border-b">
                    <th class="p-3 text-sm text-gray-600 font-semibold">Title</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Experience</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Salary</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Type</th>
                    <th class="p-3 text-sm text-gray-600 font-semibold">Action</th>

                </tr>
                </thead>
                <tbody id="jobs-body">
                <!-- Jobs will be loaded here -->
                </tbody>
            </table>
        </div>

        <div class="text-center mt-6">
            <button id="loadMoreBtn"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                Load More
            </button>
        </div>
    </div>

    <script>
        let currentPage = 1;
        let totalPages = 1;
        let isLoading = false;

        async function loadJobs(page = 1) {
            if (isLoading) return;
            isLoading = true;

            const loadBtn = document.getElementById('loadMoreBtn');
            loadBtn.textContent = "Loading...";

            try {
                const res = await fetch(`{{ route('emp.getJobs') }}?page=${page}`);
                if (!res.ok) throw new Error("Failed to fetch jobs");

                const data = await res.json();

                totalPages = data.total_pages;
                currentPage = data.current_page;

                const tbody = document.getElementById('jobs-body');

                data.data.forEach(job => {
                    const tr = document.createElement('tr');
                    tr.classList.add("border-b", "hover:bg-gray-50");
                    tr.innerHTML = `
                        <td class="p-3 text-sm text-gray-700">${job.title}</td>
                        <td class="p-3 text-sm text-gray-700">${job.experience ?? 'N/A'}</td>
                        <td class="p-3 text-sm text-gray-700">${job.salary ? 'Rs. ' + job.salary : 'N/A'}</td>
                        <td class="p-3 text-sm text-gray-700">${job.type ?? 'N/A'}</td>
                        <td> <a  class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition"
 href="/employer/edit_job/${job.job_id}"> Edit </a>
                     <form method="POST" action="/employer/delete/${job.job_id}" style="display:inline;">
                        @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="bg-red-500 text-white rounded-lg font-semibold px-5 py-2 hover:bg-red-600 transition">Delete</button>
            </form>
</td>

                    `;
                    tbody.appendChild(tr);
                });

                if (currentPage >= totalPages) {
                    loadBtn.style.display = 'none';
                } else {
                    loadBtn.style.display = 'inline-block';
                    loadBtn.textContent = "Load More";
                }
            } catch (e) {
                console.error('Error loading jobs:', e);
                alert("Something went wrong while loading jobs.");
            } finally {
                isLoading = false;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadJobs(); // Load first page
        });

        document.getElementById('loadMoreBtn').addEventListener('click', () => {
            if (currentPage < totalPages) {
                loadJobs(currentPage + 1);
            }
        });
    </script>
@endsection
