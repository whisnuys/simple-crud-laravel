@extends('Layout/isGuest')

@section('content')
    {{-- <div>
        <h3>Register Page</h3>
        <i>{{ session()->get('message') }}</i>
        <form method="POST" action={{ route('register_action') }}>
            {{-- agar secure dan tidak error post (token csrf) --}}
    {{-- @csrf
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <button type="submit">Register</button>
        </form>

        <a href="/login">Login</a>
    </div> --}}


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="w-full flex justify-center text-center pt-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error</strong>
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            </div>
        @endforeach
    @endif
    <div class="mx-auto py-12 my-12 px-4 sm:px-6 lg:px-8 max-w-sm rounded shadow-lg">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create New Admin Account</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or
                    <a href="/login" class="font-medium text-green-600 hover:text-green-500">Login with existing admin
                        account
                    </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" action={{ route('register_action') }} method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <input id="username" name="username" type="username" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                        placeholder="Username">

                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                        placeholder="Password">
                </div>
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
