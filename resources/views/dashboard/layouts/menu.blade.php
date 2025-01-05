<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">

        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ isActiveRoute('home') }}" href="{{route('home')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.home')</span>
                </a>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">@lang('dashboard.pages')</span>
        </div>
    </div>


    @if(hasAnyPermissions(['categories.index' , 'categories.create' , 'categories.edit']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['categories.index' , 'categories.create' , 'categories.edit'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['categories.index' , 'categories.create' , 'categories.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi-layers-fill fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.categories')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            @if(hasPermission('categories.index'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('categories.index') }}" class="menu-link py-3  {{ isActiveRoute('categories.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.categories')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
            @if(hasPermission('categories.create'))

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('categories.create')}}" class="menu-link py-3 {{ isActiveRoute('categories.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.category')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
    @endif

    @if(hasAnyPermissions(['banners.index' , 'banners.create' , 'banners.edit']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['banners.index' , 'banners.create' , 'banners.edit'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['banners.index' , 'banners.create' , 'banners.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi-images fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.banners')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            @if(hasPermission('banners.index'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('banners.index') }}" class="menu-link py-3  {{ isActiveRoute('banners.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.banners')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif

            @if(hasPermission('banners.create'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('banners.create')}}" class="menu-link py-3 {{ isActiveRoute('banners.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.banner')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
        </div>
        <!--end::Menu sub-->

    </div>
    <!--end::Menu item-->
    @endif


    @if(hasAnyPermissions(['initial-pages.index' , 'initial-pages.create' , 'initial-pages.edit']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['initial-pages.index' , 'initial-pages.create' , 'initial-pages.edit'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['initial-pages.index' , 'initial-pages.create' , 'initial-pages.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi-book-half fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.initial_pages')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            @if(hasPermission('initial-pages.index'))

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('initial-pages.index') }}" class="menu-link py-3  {{ isActiveRoute('initial-pages.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.initial_pages')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
            @if(hasPermission('initial-pages.create'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('initial-pages.create')}}" class="menu-link py-3 {{ isActiveRoute('initial-pages.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.initial_page')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
   @endif

   @if(hasAnyPermissions(['roles.index' , 'roles.create' , 'roles.edit']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['roles.index' , 'roles.create' , 'roles.edit'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['roles.index' , 'roles.create' , 'roles.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi-patch-check-fill fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.roles')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            @if(hasPermission('roles.index'))

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('roles.index') }}" class="menu-link py-3  {{ isActiveRoute('roles.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.roles')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
            @if(hasPermission('roles.create'))

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('roles.create')}}" class="menu-link py-3 {{ isActiveRoute('roles.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.role')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
   @endif

   @if(hasAnyPermissions(['admins.index' , 'admins.create' , 'admins.edit']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['admins.index' , 'admins.create' , 'admins.edit'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['admins.index' , 'admins.create' , 'admins.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi bi-people fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.admins')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            @if(hasPermission('admins.index'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('admins.index') }}" class="menu-link py-3  {{ isActiveRoute('admins.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.admins')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
            @if(hasPermission('admins.create'))

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('admins.create')}}" class="menu-link py-3 {{ isActiveRoute('admins.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.admin')])</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
   @endif



    @if(hasAnyPermissions(['products.index' , 'products.create' , 'products.edit']))

        <!--begin::Menu item-->
        <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['products.index' , 'products.create' , 'products.edit'])}}" data-kt-menu-trigger="click">
            <!--begin::Menu link-->
            <a href="#" class="menu-link py-3 {{areActiveRoutes(['products.index' , 'products.create' , 'products.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi bi-people fs-3"></i>
            </span>
                <span class="menu-title">@lang('dashboard.products')</span>
                <span class="menu-arrow"></span>
            </a>
            <!--end::Menu link-->

            <!--begin::Menu sub-->
            <div class="menu-sub menu-sub-accordion pt-3">
                @if(hasPermission('products.index'))
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a href="{{ route('products.index') }}" class="menu-link py-3  {{ isActiveRoute('products.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                            <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.products')])</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                @endif
                @if(hasPermission('products.create'))

                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a href="{{route('products.create')}}" class="menu-link py-3 {{ isActiveRoute('products.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                            <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.product')])</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                @endif
            </div>
            <!--end::Menu sub-->
        </div>
        <!--end::Menu item-->
    @endif



@if(hasAnyPermissions(['orders.index' , 'orders.orders-by-status']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['orders.index' , 'orders.orders-by-status'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['orders.index' , 'orders.orders-by-status'])}}">
            <span class="menu-icon">
                <i class="bi bi bi-cart4 fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.orders')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            <!--begin::Menu item-->
                @if(hasPermission('orders.index'))
                <div class="menu-item">
                    <a href="{{route('orders.index')}}" class="menu-link py-3 {{isActiveRoute('orders.index')}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.orders')])</span>
                    </a>
                </div>
                @endif

                @if(hasPermission('orders.orders-by-status'))
                <div class="menu-item">
                    <a class="menu-link {{isActiveURLSegment('pending' , 2)}}" href="{{ route('orders.orders-by-status' , ['status' => 'pending']) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">@lang('apis.pending_orders')</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('orders.orders-by-status' , ['status' => 'preparing']) }}" class="menu-link py-3 {{isActiveURLSegment('preparing' , 2)}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">@lang('apis.preparing_orders')</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('orders.orders-by-status' , ['status' => 'done']) }}" class="menu-link py-3 {{isActiveURLSegment('done' , 2)}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">@lang('apis.done_orders')</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('orders.orders-by-status' , ['status' => 'cancelled']) }}" class="menu-link py-3 {{isActiveURLSegment('cancelled' , 2)}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">@lang('apis.cancelled_orders')</span>
                    </a>
                </div>
                @endif
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
    @endif

    @if(hasAnyPermissions(['users.index' , 'users.create' , 'users.edit']))

    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['users.index' , 'users.create' , 'users.edit'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['users.index' , 'users.create' , 'users.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi-people-fill fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.users')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('users.index') }}" class="menu-link py-3  {{ isActiveRoute('users.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.users')])</span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('users.create')}}" class="menu-link py-3 {{ isActiveRoute('users.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.user')])</span>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
    @endif


    @if(hasAnyPermissions(['notifications.index' , 'notifications.create']))
    <!--begin::Menu item-->
    <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['notifications.index' , 'notifications.create'])}}" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3 {{areActiveRoutes(['notifications.index' , 'notifications.create'])}}">
            <span class="menu-icon">
                <i class="bi bi-bell fs-3"></i>
            </span>
            <span class="menu-title">@lang('dashboard.notifications')</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            @if(hasPermission('notifications.index'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{ route('notifications.index') }}" class="menu-link py-3  {{ isActiveRoute('notifications.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.notifications')])</span>
                </a>
            </div>
            @endif
            <!--end::Menu item-->
            @if(hasPermission('notifications.create'))
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('notifications.create')}}" class="menu-link py-3 {{ isActiveRoute('notifications.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">@lang('dashboard.send_notification')</span>
                </a>
            </div>
            <!--end::Menu item-->
            @endif
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
    @endif

    @if(hasAnyPermissions(['socials.index' , 'socials.create' , 'socials.edit', 'socials.destroy' , 'socials.deleteAll']))
        <!--begin::Social item-->
        <div class="menu-item menu-sub-indention menu-accordion  {{areActiveRoutes(['socials.index' , 'socials.create' , 'socials.edit'])}}" data-kt-menu-trigger="click">
            <!--begin::Menu link-->
            <a href="#" class="menu-link py-3 {{areActiveRoutes(['socials.index' , 'socials.create' , 'socials.edit'])}}">
            <span class="menu-icon">
                <i class="bi bi-share fs-3"></i>
            </span>
                <span class="menu-title">@lang('dashboard.socials')</span>
                <span class="menu-arrow"></span>
            </a>
            <!--end::Menu link-->

            <!--begin::Menu sub-->
            <div class="menu-sub menu-sub-accordion pt-3">
                @if(hasPermission('socials.index'))
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a href="{{ route('socials.index') }}" class="menu-link py-3  {{ isActiveRoute('socials.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                        <span class="menu-title">@lang('dashboard.all_title', ['page_title' => __('dashboard.socials')])</span>
                    </a>
                </div>
                <!--end::Menu item-->
                @endif

                @if(hasPermission('socials.create'))
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a href="{{route('socials.create')}}" class="menu-link py-3 {{ isActiveRoute('socials.create') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                        <span class="menu-title">@lang('dashboard.create_title', ['page_title' => __('dashboard.social')])</span>
                    </a>
                </div>
                <!--end::Menu item-->
                @endif
            </div>
            <!--end::Menu sub-->
        </div>
        <!--end::Social item-->
    @endif


    @if(hasAnyPermissions(['contacts.index' , 'contacts.replay' , 'contacts.destroy' , 'contacts.deleteAll']))
    <!--Start :Single Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item">
            <a href="{{ route('contacts.index') }}" class="menu-link py-3 {{ isActiveRoute('contacts.index') }}">
                <span class="menu-icon">
                    <i class="bi bi-envelope fs-3"></i>
                </span>
                <span class="menu-title">@lang('dashboard.contacts')</span>
            </a>
        </div>
        <!--end::Menu item-->
    <!--End:Single Menu item-->
    @endif
    <!--Start :Single Menu item-->
    @if(hasPermission('settings'))
    <!--Start :Single Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item">
            <a href="{{ route('settings') }}" class="menu-link py-3 {{ isActiveRoute('settings') }}">
                <span class="menu-icon">
                    <i class="bi bi-gear fs-3"></i>
                </span>
                <span class="menu-title">@lang('dashboard.settings')</span>
            </a>
        </div>
        <!--end::Menu item-->
    <!--End:Single Menu item-->
    @endif
    <!--End:Single Menu item-->


     <!--Start :Single Menu item-->
        <!--begin::Menu item-->
        {{-- <div class="menu-item">
            <a href="{{ route('sms-counter') }}" class="menu-link py-3 {{ isActiveRoute('sms-counter') }}">
                <span class="menu-icon">
                    <i class="bi bi-gear fs-3"></i>
                </span>
                <span class="menu-title">@lang('dashboard.sms_counter')</span>
            </a>
        </div> --}}
        <!--end::Menu item-->
    <!--End:Single Menu item-->
</div>
