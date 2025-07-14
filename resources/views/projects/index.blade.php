@extends('layouts.app')

@section('content')
<div class="p-6 flex justify-center">
    <div class="w-full max-w-6xl">



        <!-- Judul -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Project Monitoring</h1>
            <a href="{{ route('projects.create') }}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                New Project
            </a>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr>
                            <th class="p-3 text-left">Project Name</th>
                            <th class="p-3 text-left">Client</th>
                            <th class="p-3 text-left">Project Leader</th>
                            <th class="p-3 text-left">Start Date</th>
                            <th class="p-3 text-left">End Date</th>
                            <th class="p-3 text-left">Progress</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        @php
                        $start = \Carbon\Carbon::parse($project->start_date);
                        $end = \Carbon\Carbon::parse($project->end_date);
                        $today = \Carbon\Carbon::today();
                        $total = $start->diffInDays($end);
                        $passed = $start->diffInDays(min($today, $end));
                        $progress = $total > 0 ? min(100, round(($passed / $total) * 100)) : 0;
                        @endphp
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $project->title }}</td>
                            <td class="p-3">{{ $project->client }}</td>
                            <td class="p-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $project->leader_photo) }}" class="w-10 h-10 rounded-full object-cover" alt="Foto Leader">
                                    <div>
                                        <div class="font-semibold">{{ $project->leader_name }}</div>
                                        <div class="text-xs text-gray-500">{{ $project->leader_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('d M Y') }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('d M Y') }}</td>
                            <td class="p-3"
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="h-4 rounded-full {{ $progress == 100 ? 'bg-green-500' : 'bg-blue-500' }}" style="width: {{ $progress }}%"></div>
            </div>
            <span class="text-sm">{{ $progress }}%</span>
            </td>
            <td class="p-3 flex gap-2">
                <!-- Update -->
                <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5l3 3L13 14l-4 1 1-4 8.5-8.5z" />
                    </svg>
                </a>
                <!-- Delete -->
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Delete this data?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-3h4m-4 0a1 1 0 00-1 1v1h6V5a1 1 0 00-1-1m-4 0h4" />
                        </svg>
                    </button>
                </form>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            <div class="flex">
                <div class="flex justify-between mt-4">
                    @if ($projects->onFirstPage())
                    <span class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        Previous
                    </span>
                    @else
                    <a href="{{ $projects->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        Previous
                    </a>
                    @endif

                    @if ($projects->hasMorePages())
                    <a href="{{ $projects->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                        Next
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    @else
                    <span class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                        Next
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </span>
                    @endif
                </div>

            </div>

        </div>
    </div>
    <!-- Button Logout -->
    <div class="w-full p-4 flex justify-end bg-gray-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                Logout
            </button>
        </form>
    </div>

</div>
</div>
@endsection