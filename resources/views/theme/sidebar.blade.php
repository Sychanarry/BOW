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

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>List Todo</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Todo</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Accordion</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-heading">Manage User</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('user.index') }}">
                <i class="bi bi-person"></i>
                <span>Manage User</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>
</aside>
