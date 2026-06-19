@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-md rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold tracking-tight">Register</h1>
        <p class="mt-1 text-sm text-slate-600">Kreirajte nalog i nastavite na products.</p>

        <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input id="password" name="password" type="password" required class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                Register
            </button>
        </form>

        <p class="mt-4 text-sm text-slate-600">
            Imate nalog?
            <a href="{{ route('login') }}" class="font-medium text-slate-900 underline">Login</a>
        </p>
    </div>
@endsection
