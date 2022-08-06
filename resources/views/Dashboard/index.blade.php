@extends('Layout/isUser')

@section('content')
    @if ($message = Session::get('success'))
        <div class="w-full flex justify-center text-center pt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success</strong>
                <span class="block sm:inline">{{ $message }}</span>

            </div>
        </div>
    @endif

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


    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-16">
        <div class="w-full lg:w-1/5 px-6 text-xl text-gray-800 leading-normal">
            <div
                class="w-full sticky inset-0 max-h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20">
                <ul class="py-2 md:py-0">
                    <li
                        class="py-1 md:my-2 hover:bg-green-100 lg:hover:bg-transparent border-l-4 border-transparent font-bold border-green-600">
                        <a href='/dashboard'
                            class="block pl-4 align-middle text-gray-700 no-underline hover:text-green-600">
                            <span class="pb-1 md:pb-0 text-base">Dashboard Home</span>
                        </a>
                    </li>
                    <li
                        class="py-1 md:my-2 hover:bg-green-100 lg:hover:bg-transparent border-l-4 border-transparent font-bold border-green-600">
                        <a href='#article' class="block pl-4 align-middle text-gray-700 no-underline hover:text-green-600">
                            <span class="pb-1 md:pb-0 text-base">Article</span>
                        </a>
                    </li>
                    <li class="mt-10">
                        <form action={{ route('dashboard_logout') }} method="POST">
                            @csrf
                            <input type="hidden" name="token" value={{ $users->token }} />
                            <button
                                class="text-base bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <section class="w-full lg:w-4/5">
            <h1 class="flex items-center  font-bold break-normal text-gray-700 px-2 lg:text-4xl mt-12 lg:mt-0 md:text-2xl">
                {{ $title }}
            </h1>
            <hr class="bg-gray-300 my-12">
            <div class="mx-auto py-6 my-12 px-4 sm:px-6 lg:px-8  rounded shadow-lg">
                <div class="max-w-md w-full space-y-8">
                    <h2 class="mt-2 text-2xl font-extrabold text-gray-900">Add New Article</h2>
                    <form class="mt-8 space-y-6" action={{ route('article_add_action') }} method="POST">
                        @csrf
                        <div class="rounded-md shadow-sm -space-y-px ">
                            <input type="text" name="title" required
                                class="appearance-none rounded  block w-full px-3 py-2 mb-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                                placeholder="Title">

                            <textarea name="description" type="text" required
                                class="resize-y appearance-none rounded  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                                placeholder="Description"></textarea>

                            <input type="text" name="tag" required
                                class="appearance-none rounded  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                                style="margin-top: 12px" placeholder="Tag">
                        </div>

                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Add
                        </button>

                    </form>
                </div>
            </div>
            <div id="article" class="mx-auto py-6 my-12 px-4 sm:px-6 lg:px-8  rounded shadow-lg">
                <h2 class="mt-2 text-2xl font-extrabold text-gray-900 pb-6">Article</h2>
                <div class="overflow-x-auto relative shadow-lg sm:rounded-lg">
                    <table class="w-full text-base text-left text-gray-500 ">
                        <thead class="text-base text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    ID
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Title
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Description
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Tag
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $article->id }}</td>
                                    <td class="py-4 px-6">{{ $article->title }}</td>
                                    <td class="py-4 px-6">{{ $article->description }}</td>
                                    <td class="py-4 px-6">{{ $article->tag }}</td>
                                    <td class="py-4 px-6">
                                        <a href="article/{{ $article->id }}/edit"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('article_delete_action') }}">
                                            @csrf
                                            <input type="hidden" name="id" value={{ $article->id }}>
                                            <button type="submit"
                                                class="font-medium text-red-600 border-none appearance-none dark:text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endsection
