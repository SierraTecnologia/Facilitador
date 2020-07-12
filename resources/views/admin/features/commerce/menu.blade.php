
<li class="sidebar-header"><span><span class="fa fa-bank"></span> E-Commerce</span></li>

<li class="nav-item @if (Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/commerce-analytics') || Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/commerce-analytics/*')) active @endif">
    <a class="nav-link" href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/commerce-analytics') }}"><span class="fa fa-fw fa-line-chart"></span> Analytics</a>
</li>
<li class="nav-item @if (Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/products') || Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/products/*')) active @endif">
    <a class="nav-link" href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/products') }}"><span class="fa fa-fw fa-archive"></span> Products</a>
</li>
<li class="nav-item @if (Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/plans') || Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/plans/*')) active @endif">
    <a class="nav-link" href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/plans') }}"><span class="fa fa-fw fa-credit-card"></span> Subscription Plans</a>
</li>
<li class="nav-item @if (Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/coupons') || Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/coupons/*')) active @endif">
    <a class="nav-link" href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/coupons') }}"><span class="fa fa-fw fa-ticket"></span> Coupons</a>
</li>
<li class="nav-item @if (Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/transactions') || Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/transactions/*')) active @endif">
    <a class="nav-link" href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/transactions') }}"><span class="fa fa-fw fa-dollar"></span> Transactions</a>
</li>
<li class="nav-item @if (Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/orders') || Request::is(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/orders/*')) active @endif">
    <a class="nav-link" href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.backend-route-prefix', 'siravel').'/orders') }}"><span class="fa fa-fw fa-ship"></span> Orders</a>
</li>
