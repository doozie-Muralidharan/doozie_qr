<nav class="navbar navbar-expand-lg bg-black p-0">
    <div class="container">
        @yield('logo_img')
        <div class="d-flex align-items-center justify-content-end d-md-none d-lg-none d-lg-block" style="position: absolute; right: 62px; top: 20px;">
            @yield('phone_number')
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-light"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav" id="myTab" role="tablist">
                @yield('menu')
            </ul>
        </div>

        <div class="d-flex align-items-center justify-content-end d-none d-md-flex">
            @yield('phone_number')
        </div>
    </div>

    <!-- Add this new div to modify the menu items -->
    <div class="bg-black collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            @yield('menu')
        </ul>
    </div>
</nav>

<style>
    /* Style the menu when expanded */
    .navbar-nav .nav-item {}

    .navbar-nav .nav-link {
        margin-top: 5px;
        padding: 10px;
        color: #fff;
    }
</style>