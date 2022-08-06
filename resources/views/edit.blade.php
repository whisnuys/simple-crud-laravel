@extends('Layout/isUser')

@section('content')
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
    <div class="container w-full flex flex-wrap mx-auto">
        <div class="mx-auto py-12 my-12 px-4 sm:px-6 lg:px-8 max-w-lg w-full rounded shadow-lg">
            <div class="max-w-md w-full space-y-8">
                <h2 class="mt-2 text-2xl font-extrabold text-gray-900">Edit Article</h2>
                <form class="mt-8 space-y-6" action={{ route('article_update_action', [$article->id]) }} method="POST">
                    @method('put')
                    @csrf
                    <div class="rounded-md shadow-sm -space-y-px ">
                        <input type="text" name="title" required
                            class="appearance-none rounded  block w-full px-3 py-2 mb-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            value="{{ $article->title }}">

                        <textarea name="description" type="text" required
                            class="resize-y appearance-none rounded  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm">{{ $article->description }}</textarea>

                        <input type="text" name="tag" required
                            class="appearance-none rounded  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            style="margin-top: 12px" value="{{ $article->tag }}">
                    </div>

                    <button type="submit"
                        class="group relative inline-block  py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Update
                    </button>
                    <a href="/dashboard" class="mx-2 inline-block">
                        <button type="button"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Cancel
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
