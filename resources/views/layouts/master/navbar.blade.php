<nav class="navbar bg-base-200 shadow-md px-4">
    <div class="flex-1">
        <a href="{{ url('/') }}" class="btn btn-ghost normal-case text-xl">LOGO</a>
    </div>
    <div class="flex-none gap-2 items-center flex">

        <!-- Dark mode toggle -->
        <label class="swap swap-rotate">

            <!-- Hidden checkbox -->
            <input type="checkbox" id="dark-toggle" />

            <!-- Sun icon (light mode) -->
            <svg class="swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M5.64 17.36a9 9 0 0112.72-12.72 9 9 0 01-12.72 12.72z" />
            </svg>

            <!-- Moon icon (dark mode) -->
            <svg class="swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
            </svg>

        </label>

        <!-- User login dropdown -->
        @auth
            <div class="dropdown dropdown-end ml-4">
                <label tabindex="0" class="btn btn-ghost rounded-btn">
                    {{ Auth::user()->name }}
                    <svg class="ml-2 h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary ml-4">Login</a>
        @endauth
    </div>
</nav>
