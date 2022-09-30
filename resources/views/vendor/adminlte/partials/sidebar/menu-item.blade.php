@inject('sidebarItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\SidebarItemHelper')

@if ($sidebarItemHelper->isHeader($item))

    @include('adminlte::partials.sidebar.menu-item-header')

{{-- @elseif ($sidebarItemHelper->isLegacySearch($item) || $sidebarItemHelper->isCustomSearch($item)) --}}

    {{-- @include('adminlte::partials.sidebar.menu-item-search-form') --}}

{{-- @elseif ($sidebarItemHelper->isMenuSearch($item))

    @include('adminlte::partials.sidebar.menu-item-search-menu') --}}

@elseif ($sidebarItemHelper->isSubmenu($item))

    @include('adminlte::partials.sidebar.menu-item-treeview-menu')

@elseif ($sidebarItemHelper->isLink($item))

    @include('adminlte::partials.sidebar.menu-item-link')

@endif

