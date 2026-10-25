<nav class="navbar navbar-expand-lg bg-light px-3">

    <a class="navbar-brand" href="{{ url('/dashboard') }}">
        Student App
    </a>

    <div class="ms-auto">

        @auth

            <span class="me-3">
                {{ Auth::user()->name }}
            </span>

            <a href="{{ url('/profile') }}" class="btn btn-primary me-2">
                Profile
            </a>

            <form method="POST"
                  action="{{ route('logout') }}"
                  class="d-inline">

                @csrf

                <button type="submit" class="btn btn-danger">
                    Logout
                </button>

            </form>

        @endauth

    </div>

</nav>