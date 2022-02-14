<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            {{--<i class="fas fa-laugh-wink"></i>--}}
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @php
        //Creación menú según rol
        $MyNavBar = \Menu::make('MenuList', function ($menu) {
            $menu->raw(__('Menu'), ['class' => 'iq-menu-title'])->prepend('<i class="ri-separator"></i>');
            $menu->add('<span>'.__("Inicio").'</span>', ['class' => 'nav-item', 'route' => 'home'])
                ->prepend('<i class="fas fa-home"></i>')->active('/*')
                ->link->attr(['class' => 'iq-waves-effect']);
            $menu1 = $menu->add('<span>'.__("Mi Proveedor").'</span>')
                    ->prepend('<i class="fas fa-fw fa-building"></i>')->active('/*')
                    ->attr(['class' => 'iq-waves-effect']);
            $menu1->add(__('Traducciones'), ['route' => 'languages.index']);
            $menu1->add(__('Riesgos'), '#');
            $menu2 = $menu->add('<span>API</span>')
                    ->prepend('<i class="fas fa-fw fa-building"></i>')->active('/*')
                    ->attr(['class' => 'iq-waves-effect']);
            $menu2->add(__('Usuarios'), ['route' => 'admin.user']);
        })->filter(function ($item) {
            return $item;
        });
    @endphp
    <!-- Nav Item - Pages Collapse Menu -->
    @include(('vendor.menu.bootstrap-navbar-items'), ['items' => $MyNavBar->roots()])

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
