<div class="vertical-menu">
    <div id="sidebar-menu" class="mm-active">
        <ul class="metismenu list-unstyled mm-show" id="side-menu">
            @canany([
               'permission.show',
               'roles.show',
               'user.show'])
                <li class="{{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'mm-active':''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="bx bxs-cog"></i>
                        <span>User Management</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li class="{{ Request::is('user*') ? "mm-active":'' }}">
                            <a class="waves-effect" href="{{ route('userIndex') }}"><i class="bx bx-user"></i> Users</a>
                        </li>
                        <li class="{{ Request::is('role*') ? "mm-active":'' }}">
                            <a class="waves-effect" href="{{ route('roleIndex') }}"><i class="bx bx-lock-open-alt"></i> Roles</a>
                        </li>
                        <li class="{{ Request::is('permission*') ? "mm-active":'' }}">
                            <a href="{{ route('permissionIndex') }}"><i class="bx bxs-folder-open"></i> Permissions</a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @can('api-user.view')
                <li class="{{ Request::is('api-users*') ? "mm-active":'' }}">
                    <a class="waves-effect" href="{{ route('api-userIndex') }}">
                        <i class="mdi mdi-api"></i><span> API Users</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
