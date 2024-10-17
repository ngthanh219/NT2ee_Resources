<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title">
                <span>
                    Cpanel hệ thống
                </span>
            </a>
        </div>

        <div class="clearfix"></div>

        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Danh mục hệ thống</h3>
                <ul class="nav side-menu">
                    <li class="{{ request()->is('*users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            Thông tin người dùng
                        </a>
                    </li>

                    <li class="{{ request()->is('*categories*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}">
                            <i class="fa fa-clone"></i>
                            Danh mục
                        </a>
                    </li>

                    <li class="{{ request()->is('*attributes*') ? 'active' : '' }}">
                        <a href="{{ route('attributes.index') }}">
                            <i class="fa fa-table"></i>
                            Loại sản phẩm
                        </a>
                    </li>

                    <li class="{{ request()->is('*products*') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-database"></i>
                            Sản phẩm
                        </a>
                    </li>

                    <li class="{{ request()->is('*stores*') ? 'active' : '' }}">
                        <a href="{{ route('stores.index') }}">
                            <i class="fa fa-location-arrow"></i>
                            Hệ thống cửa hàng
                        </a>
                    </li>

                    <li class="{{ request()->is('*orders*') ? 'active' : '' }}">
                        <a href="{{ route('orders.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            Đơn hàng
                        </a>
                    </li>

                    <li class="{{ request()->is('*dashboard*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-bar-chart-o"></i>
                            Thống kê
                        </a>
                    </li>

                    <li class="{{ request()->is('*posts*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-newspaper-o"></i>
                            Bài viết
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
