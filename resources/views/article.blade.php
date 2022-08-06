@extends('Layout/isGuest')

@section('content')
    <div class="w-full md:max-w-3xl mx-auto pt-20">
        <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal">
            <div>
                <p class="text-base md:text-sm text-green-500 font-bold">&lt; <a href="/"
                        class="text-base md:text-sm text-green-500 font-bold no-underline hover:underline">Back to Home</a>
                </p>
                <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">
                    {{ $article->title }}</h1>
            </div>
            <p class="py-6">
                {{ $article->description }}
            </p>
        </div>
        <div class="text-base md:text-sm text-gray-500 px-4 py-6">
            Tags: <a href="#"
                class="text-base md:text-sm text-green-500 no-underline hover:underline">{{ $article->tag }}</a>
        </div>
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">
    </div>
@endsection
