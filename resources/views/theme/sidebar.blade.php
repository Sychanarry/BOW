<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        {{-- this menu can only admin --}}
       @if(auth()->user()->role=='admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('project.index') }}">
                    <i class="bi bi-folder"></i>
                    <span>Project</span>
                </a>
            </li><!-- End Project Nav -->
       @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('todo.index') }}">
                <i class="bi bi-folder-plus"></i>
                <span>Everything Todo</span>
            </a>
        </li><!-- End Everything Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('working.index') }}">
                <i class="bi bi-folder2-open"></i>
                <span>My Working</span>
            </a>
        </li><!-- End Everything Nav -->
        {{-- this menu can only admin --}}
        @if(auth()->user()->role=='admin')
            <li class="nav-heading">Manage User</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Manage User</span>
                </a>
            </li><!-- End Profile Page Nav -->
        @endif
    </ul>
</aside>
