<nav x-data="{ open: false }">
    <div class="row pt-4">
        <div class="col">
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a href="/dashboard" class="text-decoration-none">
                        <h2 class="dashboard-title">
                            {{ Auth::user()->name }}'s BELLs
                        </h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary border-0">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
