@extends('Layout/isGuest')

@section('content')
    <h3 class="lg:text-2xl text-xl font-bold text-center py-10">{{ $title }}</h3>
    <div class="grid lg:grid-cols-3 gap-4 grid-cols-2 pb-10">
        @foreach ($articles as $article)
            <div class="grid auto p-6 bg-white rounded-lg border border-gray-200 shadow-md content-between">
                <div>
                    <span
                        class="bg-[#dbfee1] text-[#1eaf34] text-xs font-medium inline-flex items-center mb-2 px-2.5 py-0.5 rounded">
                        {{ $article->tag }}
                    </span>
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $article->title }}
                    </h5>

                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($article->description, 50) }}
                    </p>
                </div>

                <a href="/article/{{ $article->id }}"
                    class="inline-flex w-[120px] items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                    Read more
                    <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            {{-- <div>
                <h3><a href="/article/{{ $article->id }}">{{ $article->title }}</a></h3>
            </div> --}}
        @endforeach
    </div>
@endsection
