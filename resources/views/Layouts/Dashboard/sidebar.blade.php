<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{config("app.name")}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route("admin.dashboard")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Users Menu -->
    @can("users")
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
               aria-expanded="false" aria-controls="collapseUsers">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span>
            </a>
            <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Users:</h6>
                    <a class="collapse-item" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> View Users
                    </a>
                </div>
            </div>
        </li>
    @endcan

    <!-- Nav Item - Categories Menu -->
    @can("categories")
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
               aria-expanded="false" aria-controls="collapseCategories">
                <i class="fas fa-fw fa-table"></i>
                <span>Categories</span>
            </a>
            <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Categories:</h6>
                    <a class="collapse-item" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> View Categories
                    </a>
                </div>
            </div>
        </li>
    @endcan
    <!-- Nav Item - Posts Menu -->
    @can("posts")
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePosts"
               aria-expanded="false" aria-controls="collapsePosts">
                <i class="fas fa-fw fa-table"></i>
                <span>Posts</span>
            </a>
            <div id="collapsePosts" class="collapse" aria-labelledby="headingPosts" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Posts:</h6>
                    <a class="collapse-item" href="{{ route('admin.posts.index') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> View Posts
                    </a>
                </div>
            </div>
        </li>

    @endcan
    <!-- Nav Item - Posts Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContacts"
               aria-expanded="false" aria-controls="collapseContacts">
                <i class="fas fa-fw fa-table"></i>
                <span>Contacts</span>
            </a>
            <div id="collapseContacts" class="collapse" aria-labelledby="headingPosts" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Contacts:</h6>
                    <a class="collapse-item" href="{{ route('admin.contact.index') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> View Contacts
                    </a>
                </div>
            </div>
        </li>
    @can("admins")
        <!-- Nav Item - Admins Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmins"
               aria-expanded="false" aria-controls="collapsePosts">
                <i class="fas fa-fw fa-table"></i>
                <span>Admins</span>
            </a>
            <div id="collapseAdmins" class="collapse" aria-labelledby="headingPosts" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Admins:</h6>
                    <a class="collapse-item" href="{{ route('admin.admins.index') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> View Admins
                    </a>
                </div>
            </div>
        </li>
    @endcanany
    <!-- Nav Item - Roles Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
           aria-expanded="false" aria-controls="collapsePosts">
            <i class="fas fa-fw fa-table"></i>
            <span>Roles</span>
        </a>
        <div id="collapseRoles" class="collapse" aria-labelledby="headingPosts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Roles:</h6>
                <a class="collapse-item" href="{{ route('admin.roles.index') }}">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> View Roles
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
