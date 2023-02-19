<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Postrify</title>
            @vite('resources/css/app.css')
        </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-2">
            <ul class="flex items-center">
                <li>
                    <a class="p-3" href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a class="p-3" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a class="p-3" href="{{ route('posts') }}">Posts</a>
                </li>
            </ul>

            <ul class="flex items-center">

                {{-- auth()->check()     would also do --}}

                {{-- @if (auth()->user())
                    <li>
                        <a class="p-3"href="">{{ auth()->user()->username }}</a>
                    </li>
                    <li>
                        <a class="p-3"href="">Logout</a>
                    </li>
                @else
                    <li>
                        <a class="p-3"href="">Login</a>
                    </li>
                    <li>
                        <a class="p-3"href="{{ route('register') }}">Register</a>
                    </li>
                @endif --}}

                {{-- this will also do the same --}}

                @auth
                    <li>
                        <a class="p-3"href="">{{ auth()->user()->username }}</a>
                    </li>
                    <li>
                        {{-- this is done as any hacker can easily reoute a valid user to the logout by js scripting --}}
                        {{-- to avoid that we are doing it from the inside to make it more secure --}}
                        <form action="{{ route('logout') }}" method="post" class="inline p-3">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li>
                        <a class="p-3"href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a class="p-3"href="{{ route('register') }}">Register</a>
                    </li>
                @endguest


            </ul>
        </nav>
        @yield('content')
    </body>
</html>
