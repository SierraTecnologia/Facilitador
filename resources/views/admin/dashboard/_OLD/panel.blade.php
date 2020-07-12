<li class="nav-item">
    <a class="nav-link" href="{{ URL::to('/') }}"><span class="fa fa-arrow-left"></span> Back To Site </a>
</li>

<li class="nav-item @if (Request::is(siravel()->backendRoute.'/dashboard')) active @endif">
    <a class="nav-link" href="{!! url(siravel()->backendRoute.'/dashboard') !!}"><span class="fa fa-fw fa-line-chart"></span> Dashboard</a>
</li>

<li class="nav-item @if (Request::is(siravel()->backendRoute.'/help')) active @endif">
    <a class="nav-link" href="{!! url(siravel()->backendRoute.'/help') !!}"><span class="fa fa-fw fa-info-circle"></span> Help</a>
</li>

@if (Route::get('user/settings'))
    <li class="nav-item @if (Request::is('user/settings') || Request::is('user/password')) active @endif">
        <a class="nav-link" href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-wrench"></span> Settings</a>
    </li>
@endif

@if (in_array('images', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/images') || Request::is(siravel()->backendRoute.'/images/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/images') !!}"><span class="fa fa-fw fa-image"></span> Images</a>
    </li>
@endif

@if (in_array('files', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/files') || Request::is(siravel()->backendRoute.'/files/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/files') !!}"><span class="fa fa-fw fa-file"></span> Files</a>
    </li>
@endif

@if (in_array('menus', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/menus') || Request::is(siravel()->backendRoute.'/menus/*') || Request::is(siravel()->backendRoute.'/links') || Request::is(siravel()->backendRoute.'/links/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/menus') !!}"><span class="fa fa-fw fa-link"></span> Menus</a>
    </li>
@endif

@if (in_array('promotions', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/promotions') || Request::is(siravel()->backendRoute.'/promotions/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/promotions') !!}"><span class="fa fa-fw fa-clock-o"></span> Promotions</a>
    </li>
@endif

@if (in_array('widgets', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/widgets') || Request::is(siravel()->backendRoute.'/widgets/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/widgets') !!}"><span class="fa fa-fw fa-cog"></span> Widgets</a>
    </li>
@endif

@if (in_array('blog', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/blog') || Request::is(siravel()->backendRoute.'/blog/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/blog') !!}"><span class="fa fa-fw fa-pencil"></span> Blog</a>
    </li>
@endif

@if (in_array('pages', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/pages') || Request::is(siravel()->backendRoute.'/pages/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/pages') !!}"><span class="fa fa-fw fa-file-text"></span> Pages</a>
    </li>
@endif

@if (in_array('faqs', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/faqs') || Request::is(siravel()->backendRoute.'/faqs/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/faqs') !!}"><span class="fa fa-fw fa-question"></span> Faqs</a>
    </li>
@endif

@if (in_array('events', Config::get('siravel.active-core-features', Siravel::defaultFeatures())))
    <li class="nav-item @if (Request::is(siravel()->backendRoute.'/events') || Request::is(siravel()->backendRoute.'/events/*')) active @endif">
        <a class="nav-link" href="{!! url(siravel()->backendRoute.'/events') !!}"><span class="fa fa-fw fa-calendar"></span> Events</a>
    </li>
@endif

{!! ModuleService::menus() !!}

{!! Siravel::packageMenus() !!}

@if (Route::get('admin/users'))
    <li class="sidebar-header"><span>Admin</span></li>
@endif

@if (Route::get('admin/dashboard'))
    <li class="nav-item @if (Request::is('admin/dashboard') || Request::is('admin/dashboard/*')) active @endif">
        <a class="nav-link" href="{!! url('admin/dashboard') !!}"><span class="fa fa-fw fa-tachometer"></span> Dashboard</a>
    </li>
@endif
@if (Route::get('admin/users'))
    <li class="nav-item @if (Request::is('admin/users') || Request::is('admin/users/*')) active @endif">
        <a class="nav-link" href="{!! url('admin/users') !!}"><span class="fa fa-fw fa-users"></span> Users</a>
    </li>
@endif
@if (Route::get('admin/roles'))
    <li class="nav-item @if (Request::is('admin/roles') || Request::is('admin/roles/*')) active @endif">
        <a class="nav-link" href="{!! url('admin/roles') !!}"><span class="fa fa-fw fa-lock"></span> Roles</a>
    </li>
@endif
