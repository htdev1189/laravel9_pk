<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Session::get('current_user')->image }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Session::get('current_user')->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- category --}}
                <li class="nav-item">
                    <a href="/admin/category/list" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                {{-- post --}}
                <li class="nav-item">
                    <a href="/admin/posts/list" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Post
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/tongdai/list" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Phone number
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/user/list" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/thongke/all" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Thống kê
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/thongbao/all" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Thông báo
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
