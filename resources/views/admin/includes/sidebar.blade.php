<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="{{ Request::is('admin/dashboard*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.dashboard') }}" ><i class="la la-dashboard"></i> <span>Dashboard</span></a>                 
                </li>
                
                <li class="menu-title">
                    <span>Profile Section</span>
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/profile*') || Request::is('admin/password*') || Request::is('admin/detail*') ? 'active' : ' ' }}"><i class="la la-user-cog"></i> <span>Manage Account </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/profile*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.profile') }}">My Profile</a>
                        </li>
                        <li class="{{ Request::is('admin/password*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.password') }}">Change Password</a>
                        </li>
                                           
                    </ul>
                </li>
                <li class="menu-title">
                    <span>User Management</span>
                </li>
                <li class="{{ Request::is('admin/customers*') ? 'active' : ' ' }}">
                    <a href="{{ route('customers.index') }}" ><i class="la la-users"></i> <span>Manage Customers</span></a>                 
                </li>
                <li class="menu-title">
                    <span>Catalog Section</span>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/categories*') ? 'active' : ' ' }}"><i class="la la-sitemap"></i> <span>Category</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/categories*') ? 'active' : ' ' }}">
                            <a href="{{ route('categories.index') }}">Category List</a>
                        </li>   
                        <li class="{{ Request::is('admin/categories/create*') ? 'active' : ' ' }}">
                            <a href="{{ route('categories.create') }}">Create Category</a>
                        </li>        
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/products*') ? 'active' : ' ' }}"><i class="la la-cubes"></i> <span>Product</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/products*') ? 'active' : ' ' }}">
                            <a href="{{ route('products.index') }}">Product List</a>
                        </li>   
                        <li class="{{ Request::is('admin/products/create*') ? 'active' : ' ' }}">
                            <a href="{{ route('products.create') }}">Create Product</a>
                        </li>        
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Order Section</span>
                </li>
                <li class="{{ Request::is('admin/orders*') ? 'active' : ' ' }}">
                    <a href="{{ route('orders.index') }}"><i class="la la-shopping-bag"></i> <span>Customers order</span></a>                 
                </li>

                <li class="menu-title">
                    <span>Other Section</span>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/offers*')  ? 'active' : ' ' }}"><i class="la la-tag"></i> <span>Offer</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/offers*') ? 'active' : ' ' }}">
                            <a href="{{ route('offers.index') }}">List</a>
                        </li>         
                    </ul>
                </li>

                <li class="{{ Request::is('admin/contact-us*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.contact-us') }}" ><i class="la la-phone"></i> <span>Contact Us</span></a>                 
                </li>

                
                <li class="menu-title">
                    <span>Content Management</span>
                </li>
                
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/blogs*') || Request::is('admin/blog-categories*') ? 'active' : ' ' }}"><i class="la la-blog"></i> <span>Blog</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/blog-categories*') ? 'active' : ' ' }}">
                            <a href="{{ route('blog-categories.index') }}">Category</a>
                        </li>
                        <li class="{{ Request::is('admin/blogs*') ? 'active' : ' ' }}">
                            <a href="{{ route('blogs.index') }}">List</a>
                        </li>           
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/cms*') ? 'active' : ' ' }}"><i class="la la-list"></i> <span>CMS</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/cms/home-cms*') ? 'active' : ' ' }}">
                            <a href="{{ route('home.cms') }}">Home cms</a>
                        </li>   
                        <li class="{{ Request::is('admin/cms/about-cms*') ? 'active' : ' ' }}">
                            <a href="{{ route('about.cms') }}">About Cms</a>
                        </li>  
                        <li class="{{ Request::is('admin/cms/contact-us-cms*') ? 'active' : ' ' }}">
                            <a href="{{ route('contact-us.cms') }}">ContactUs Cms</a>
                        </li>          
                    </ul>
                </li>

               
                {{-- <li class="{{ Request::is('admin/members*') ? 'active' : ' ' }}">
                    <a href="{{ route('user.index') }}"><i class="la la-users"></i> <span>Members</span></a>
                </li>
                <li class="{{ Request::is('admin/group*') ? 'active' : ' ' }}">
                    <a href="{{ route('group.index') }}"><i class="la la-list"></i> <span>Groups</span></a>
                </li> --}}

                {{-- <li class="menu-title">
                    <span>Content Management System</span>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/cms/sub-admin*') ? 'active' : ' ' }}"><i class="la la-address-card"></i> <span>Admin Panel </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/cms/sub-admin*') ? 'active' : ' ' }}">
                            <a href="{{ route('cms.sub-admin.get-started') }}">Get Started Page</a>
                        </li>                   
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/cms/user*') ? 'active' : ' '}}"><i class="la la-newspaper"></i> <span>Member Panel </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/cms/user*') ? 'active' : ' ' }}">
                            <a href="{{ route('cms.user.get-started') }}">Get Started Page</a>
                        </li>                  
                    </ul>
                </li> --}}
               
            </ul> 
        </div>
    </div>
</div>


