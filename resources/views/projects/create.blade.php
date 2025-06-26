@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">New Project</h2>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white shadow-md rounded-xl p-6">
        @csrf

        <div>
            <label class="block font-medium">Project Name</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Client</label>
            <input type="text" name="client" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Leader Name</label>
            <input type="text" name="leader_name" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Leader Email</label>
            <input type="email" name="leader_email" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Leader Photo</label>
            <input type="file" name="leader_photo" class="w-full border rounded p-2" accept="image/*" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Start Date</label>
                <input type="date" name="start_date" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium">End Date</label>
                <input type="date" name="end_date" class="w-full border rounded p-2" required>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-300 rounded text-gray-800 hover:bg-gray-400 mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
