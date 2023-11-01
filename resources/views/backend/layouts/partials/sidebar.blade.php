@php
    $usr = Auth::guard('admin')->user();
@endphp
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if ($usr->can('dashboard.view'))
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu"> Dashboard </span>
                    </a>
                </li>
                @endif

                @if ($usr->can('roznamchas.create') || $usr->can('roznamchas.view') ||  $usr->can('roznamchas.edit') ||  $usr->can('roznamchas.delete'))
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu"> Roznamchas </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        @if ($usr->can('roznamchas.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.roznamchas.index') }}" class="sidebar-link">
                                <span class="hide-menu"> List of Roznamchas </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($usr->can('khatas.create') || $usr->can('khatas.view') ||  $usr->can('khatas.edit') ||  $usr->can('khatas.delete'))
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu"> Listing </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @if ($usr->can('khatas.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.khatas.index') }}" class="sidebar-link">
                                <span class="hide-menu"> Khatas Listing </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($usr->can('orders.kharlachi.create') || $usr->can('orders.kharlachi.view') ||  $usr->can('orders.kharlachi.edit') ||  $usr->can('orders.kharlachi.delete') || $usr->can('orders.ghulamkhan.create') || $usr->can('orders.ghulamkhan.view') ||  $usr->can('orders.ghulamkhan.edit') ||  $usr->can('orders.ghulamkhan.delete') || $usr->can('orders.thorkham.create') || $usr->can('orders.thorkham.view') ||  $usr->can('orders.thorkham.edit') ||  $usr->can('orders.thorkham.delete') || $usr->can('orders.wana.create') || $usr->can('orders.wana.view') ||  $usr->can('orders.wana.edit') ||  $usr->can('orders.wana.delete'))
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu"> Orders </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @if ($usr->can('orders.kharlachi.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.orders.kharlachi.index') }}" class="sidebar-link">
                                <span class="hide-menu"> Kharlachi </span>
                            </a>
                        </li>
                        @endif
                        @if ($usr->can('orders.ghulamkhan.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.orders.ghulamkhan.index') }}" class="sidebar-link">
                                <span class="hide-menu"> Ghulam Khan </span>
                            </a>
                        </li>
                        @endif
                        @if ($usr->can('orders.thorkham.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.orders.thorkham.index') }}" class="sidebar-link">
                                <span class="hide-menu"> Thorkham </span>
                            </a>
                        </li>
                        @endif
                        @if ($usr->can('orders.wana.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.orders.wana.index') }}" class="sidebar-link">
                                <span class="hide-menu"> Wana </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu"> Roles </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @if ($usr->can('role.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.roles.index') }}" class="sidebar-link">
                                <span class="hide-menu"> All Roles </span>
                            </a>
                        </li>
                        @endif
                        @if ($usr->can('role.create'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.roles.create') }}" class="sidebar-link">
                                <span class="hide-menu"> Create Role </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                    
                @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="user" class="feather-icon"></i>
                        <span class="hide-menu"> Users </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @if ($usr->can('admin.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.admins.index') }}" class="sidebar-link">
                                <span class="hide-menu"> All Users </span>
                            </a>
                        </li>
                        @endif
                        @if ($usr->can('admin.create'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.admins.create') }}" class="sidebar-link">
                                <span class="hide-menu"> Add User </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside> 
 