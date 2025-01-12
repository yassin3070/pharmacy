@extends('dashboard.layouts.app')

@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">تفاصيل الطلب</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('home')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('orders.index')}}" class="text-muted text-hover-primary">الطلبات</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">عرض تفاصيل الطلب</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->
                <form id="kt_ecommerce_add_product_form"  action="{{ route('orders.update', $order->id) }}" method="POST"
                      class="form d-flex flex-column flex-lg-row store"  data-kt-redirect="{{route('orders.index')}}" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        {{--                        <!--begin::Thumbnail settings-->--}}
                        {{--                        <div class="card card-flush py-4">--}}
                        {{--                            <!--begin::Card header-->--}}
                        {{--                            <div class="card-header">--}}
                        {{--                                <!--begin::Card title-->--}}
                        {{--                                <div class="card-title">--}}
                        {{--                                    <h2>الصورة</h2>--}}
                        {{--                                </div>--}}
                        {{--                                <!--end::Card title-->--}}
                        {{--                            </div>--}}
                        {{--                            <!--end::Card header-->--}}
                        {{--                            <!--begin::Card body-->--}}
                        {{--                            <div class="card-body text-center pt-0">--}}
                        {{--                                <!--begin::Image input-->--}}
                        {{--                                <div class="image-input image-input-empty image-input-outline mb-3"--}}
                        {{--                                    data-kt-image-input="true"--}}
                        {{--                                    style="background-image: url({{$order->user->image}})">--}}
                        {{--                                    <!--begin::Preview existing avatar-->--}}
                        {{--                                    <div class="image-input-wrapper w-150px h-150px"></div>--}}
                        {{--                                    <!--end::Preview existing avatar-->--}}
                        {{--                                    <!--begin::Label-->--}}
                        {{--                                    <label--}}
                        {{--                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"--}}
                        {{--                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"--}}
                        {{--                                        title="Change avatar">--}}
                        {{--                                        <!--begin::Inputs-->--}}
                        {{--                                        <input type="file" name="image" readonly accept=".png, .jpg, .jpeg" />--}}
                        {{--                                        <input type="hidden" name="avatar_remove" />--}}
                        {{--                                        <!--end::Inputs-->--}}
                        {{--                                    </label>--}}
                        {{--                                    <!--end::Label-->--}}
                        {{--                                </div>--}}
                        {{--                                <!--end::Image input-->--}}
                        {{--                            </div>--}}
                        {{--                            <!--end::Card body-->--}}
                        {{--                        </div>--}}
                        {{--                        <!--end::Thumbnail settings-->--}}


                        <!--begin::Status-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{__('dashboard.status')}}</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle {{$order->status == "cancelled" ? " bg-danger" :" bg-success"}}  w-15px h-15px"
                                         id="kt_ecommerce_add_category_status"></div>
                                </div>
                                <!--begin::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"
                                       class="form-control mb-2" readonly
                                       value="{{$order->status_name}}" readonly />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Status-->
                    </div>
                    <!--end::Aside column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                   href="#kt_ecommerce_add_product_ar">{{__('dashboard.client_data')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab"
                                   href="#kt_ecommerce_add_product_en">{{__('dashboard.the_order')}}</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_ar" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{__('dashboard.client_data')}}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.client_name')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text"
                                                       class="form-control mb-2" readonly
                                                       value="{{$order?->user->name}}" readonly />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.client_number')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text"
                                                       class="form-control mb-2" readonly
                                                       value="{{$order?->user->phone}}" readonly />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_en" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::Inventory-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{__('dashboard.order_details')}}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.order_num')}} </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{$order->order_num}}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">{{__('dashboard.store')}} </label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" value="{{$order?->provider->name}}"--}}
{{--                                                       class="form-control mb-2" readonly/>--}}
{{--                                                <!--end::Input-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">{{__('dashboard.branch')}} </label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" value="{{$order?->branch->name}}"--}}
{{--                                                       class="form-control mb-2" readonly/>--}}
{{--                                                <!--end::Input-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.address')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{$order?->address->address }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.items_price')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->products_price }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.shipping_price')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->shipping_price }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.fitting_price')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->fitting_price }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.tax')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->tax }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.discount')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->discount }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">الكوبون</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->coupon ? $order->coupon->code : "not use coupon" }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.total')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order->total }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.client_comment')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" value="{{ $order?->rate?->comment }}"
                                                       class="form-control mb-2" readonly/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('dashboard.rating')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div class="rating my-8">
                                                    @if($order->rate)
                                                        <!-- Example for 4.5 stars (adjust as needed) -->
                                                        @for($i = 0 ; $i < $order?->rate?->rate ;$i++)
                                                            <span class="fa fa-star" style="color: gold;"></span>
                                                        @endfor
                                                    @else
                                                        <span class="fa " > {{__('dashboard.no_rate')}}</span>
                                                    @endif

                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            {{--                                            @if($order->rate)--}}
                                            {{--                                            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">--}}
                                            {{--                                                <!--begin::Col-->--}}
                                            {{--                                                <div class="col">--}}
                                            {{--                                                    <!--begin::Option-->--}}
                                            {{--                                                    <div class="card" style="width: 18rem;">--}}
                                            {{--                                                        <div class="card-body">--}}
                                            {{--                                                            <!-- Rating section: display stars -->--}}
                                            {{--                                                            <h5 class="card-title">{{__('dashboard.rate')}}</h5>--}}
                                            {{--                                                            <br>--}}
                                            {{--                                                            <div class="rating">--}}
                                            {{--                                                                <!-- Example for 4.5 stars (adjust as needed) -->--}}
                                            {{--                                                                @for($i = 0 ; $i < $order?->rate->rate ;$i++)--}}
                                            {{--                                                                    <span class="fa fa-star" style="color: gold;"></span>--}}
                                            {{--                                                                @endfor--}}

                                            {{--                                                            </div>--}}

                                            {{--                                                            <!-- Comment section -->--}}
                                            {{--                                                            <p class="card-text mt-3">{{$order?->rate->comment}}</p>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!--end::Col-->--}}

                                            {{--                                            </div>--}}
                                            {{--                                            @endif--}}
                                            {{-- //end coupon --}}


















                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Inventory-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                         <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('orders.index') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    @section('scripts')
    @endsection

@endsection
