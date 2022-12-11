<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('project.index') }}">
                <i class="bi bi-folder"></i>
                <span>Project</span>
            </a>
        </li><!-- End Project Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('todo.index') }}">
                <i class="bi bi-folder"></i>
                <span>Everything Todo</span>
            </a>
        </li><!-- End Everything Nav -->

        <li class="nav-heading">Manage User</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('user.index') }}">
                <i class="bi bi-person"></i>
                <span>Manage User</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>
</aside>
