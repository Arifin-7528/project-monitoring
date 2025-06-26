@extends('layouts.app')

@section('content')
<div class="p-6 flex justify-center">
    <div class="w-full max-w-3xl bg-white shadow-xl rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Project</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Project Name</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Client</label>
                <input type="text" name="client" value="{{ old('client', $project->client) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Leader Name</label>
                <input type="text" name="leader_name" value="{{ old('leader_name', $project->leader_name) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Leader Email</label>
                <input type="email" name="leader_email" value="{{ old('leader_email', $project->leader_email) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Leader Photo</label>
                <div class="flex items-center gap-4 mt-1">
                    @if ($project->leader_photo)
                        <img src="{{ asset('storage/' . $project->leader_photo) }}" class="w-16 h-16 rounded-full object-cover">
                    @endif
                    <input type="file" name="leader_photo" class="border border-gray-300 rounded px-3 py-1">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('projects.index') }}" class="text-gray-600 hover:underline mr-4">Cancel</a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-semibold">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
