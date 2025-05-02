<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <!-- Full-width flex container to center everything -->
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center w-100">

                    <!-- Brand Title -->
                    <div class="text-center mb-2 mb-lg-0">
                        <h1 class="brand-title text-black fw-bold mb-0 text-center" style="font-size: calc(1.5rem + 0.8vw);">
                            Vamil Enterprises
                        </h1>
                    </div>

                    <!-- Profile Dropdown -->
                    <div>
                        <ul class="navbar-nav header-right main-notification">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{ asset('images/profile/pic1.jpg') }}" width="30" height="30" class="rounded-circle" alt=""/>
                                    <div class="header-info d-none d-sm-block">
                                        {{-- <small>{{ $authUser->name ?? 'Guest' }}</small> --}}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                   
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                             width="18" height="18" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ml-2">Logout</span>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</div>
