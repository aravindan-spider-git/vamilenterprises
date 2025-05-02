<div class="deznav">
    <div class="deznav-scroll">
        <ul id="menu" class="metismenu">
            {{-- Main Section --}}
            <li class="{{ request()->routeIs('dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="bi bi-speedometer"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('companies') ? 'mm-active' : '' }}">
                <a href="{{ route('companies.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="bi bi-speedometer"></i>
                    <span class="nav-text">Companies</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('company-categories') ? 'mm-active' : '' }}">
                <a href="{{ route('company-categories.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="bi bi-speedometer"></i>
                    <span class="nav-text">Campany Categories</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('vehicles') ? 'mm-active' : '' }}">
                <a href="{{ route('vehicles.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="bi bi-speedometer"></i>
                    <span class="nav-text">Vehicles</span>
                </a>
            </li>

 

            
        </ul>
    </div>
</div>