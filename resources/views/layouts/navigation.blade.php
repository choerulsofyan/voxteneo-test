<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('organizers.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-group') }}"></use>
            </svg>
            Organizers
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('sport-events.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-calendar') }}"></use>
            </svg>
            Sport Events
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            Users
        </a>
    </li>
</ul>
