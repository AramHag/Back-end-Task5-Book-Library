<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- Users LI --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-user mr-2"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.add') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add user</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- End User LI --}}
        {{-- Roles LI --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-user-group mr-2"></i>
                <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.add') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add new role</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.trashed') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Trashed roles</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- ENd Roles LI --}}
        {{-- Category LI --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-layer-group mr-2"></i>
                <p>
                    Categories
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.add') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add new category</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- ENd Category LI --}}
        {{-- Book LI --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-book mr-2"></i>
                <p>
                    Books
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('book.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Books</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('book.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add book</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- ENd Book LI --}}
        <li class="nav-item">
            <a href="{{ route('welcome') }}" class="btn mt-3 form-control btn-outline-secondary">Welcome Library
                <i class="right fa-solid fa-book ml-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf

                <button class="btn btn-outline-secondary mt-3 form-control">Logout
                    <i class="fa-solid fa-power-off ml-2"></i>
                </button>
            </form>
        </li>
    </ul>
</nav>
