<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">

            {{-- <h3 class="ms-1 font-weight-bold">VINR</h3> --}}
            <img src="/img/logo.png" alt="VINR">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- {{Auth :: user () -> name}} --}}
            @php
                $user_role = auth()->user()->role;
            @endphp
            @if ($user_role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="/document_type">
                        <span class="nav-link-text ms-1">Document Type</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="/packages">
                        <span class="nav-link-text ms-1">Package</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="/manage_admin">
                        <span class="nav-link-text ms-1">Manage Admin</span>
                    </a>
                </li>
            @elseif($user_role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="/customer">
                        <span class="nav-item nav-link-text ms-1">Customer Details</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="/qr_code_detail">
                        <span class="nav-link-text ms-1">QR Code Details</span>
                    </a>
                </li>
            @endif







        </ul>
    </div>

</aside>
