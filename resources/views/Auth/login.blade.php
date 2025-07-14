@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
