@extends('layouts.app')

@section('content')
<div class="p-6 flex justify-center">
    <div class="w-full max-w-6xl">

        <!-- Judul -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Project Monitoring</h1>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
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
            </div>
        </div>

    </div>
</div>
@endsection