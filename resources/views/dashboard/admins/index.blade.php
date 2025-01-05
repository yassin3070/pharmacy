@extends('dashboard.layouts.app')
@section('pageTitle' , __('dashboard.admins'))

@section('content')

<!--begin::Modal - Customers - Add-->
<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form notify-form"  action="{{ route('notify')}}" method="POST" id="kt_modal_add_customer_form" data-kt-redirect="{{route('admins.index')}}">
              @csrf
                <input type="hidden" name="id" class="notify_id">
               
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_customer_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">@lang('dashboard.send_notification')</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                      
                        <!--select notification type-->
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">@lang('dashboard.notification_type')</label>
                            <select class="form-select form-select-solid" name="notify">
                                <option value="email">@lang('dashboard.email')</option>
                                <option value="notifications">@lang('dashboard.notifications')</option>
                            </select>
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold mb-2">@lang('dashboard.notification_title_ar')</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="title_ar" value="" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold mb-2">@lang('dashboard.notification_title_en')</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="title_en" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                       
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mb-2">@lang('dashboard.notification_body_ar')</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="body_ar" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                         <!--begin::Input group-->
                         <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mb-2">@lang('dashboard.notification_body_en')</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="body_en" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">@lang('dashboard.cancel')</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary send-notify-button">
                        <span class="indicator-label">@lang('actions.submit')</span>
                        <span class="indicator-progress">@lang('dashboard.please_wait')
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Customers - Add-->

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Category-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="@lang('dashboard.search_title', ['page_title' => __('dashboard.admin')])" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Add customer-->
                    <a href="{{ route('admins.create')}}" class="btn btn-primary">@lang('dashboard.create_title', ['page_title' => __('dashboard.admin')])</a>
                    <!--end::Add customer-->
                    <span class="w-5px h-2px"></span>
                    <button type="button" data-route="{{route('admins.deleteAll')}}" 
                    class="btn btn-danger delete_all_button">
                        <i class="feather icon-trash"></i>@lang('dashboard.delete_selected')</button>

                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3" >
                                    <input class="form-check-input" id="checkedAll"  type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-250px">@lang('dashboard.name')</th>
                            <th class="min-w-250px">@lang('dashboard.role')</th>
                            <th class="min-w-250px">@lang('dashboard.send_notification')</th>
                            <th class="text-end min-w-70px">@lang('dashboard.actions')</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($users as $user)
                            <!--begin::Table row-->
                            <tr data-id="{{$user->id}}">
                                <!--begin::Checkbox-->
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                        <input class="form-check-input checkSingle" type="checkbox" value="1" id="{{$user->id}}"/>
                                    </div>
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::Category=-->
                                <td>
                                    <div class="d-flex">
                                        <!--begin::Thumbnail-->
                                        <a href="{{ route('users.edit', $user->id) }}" class="symbol symbol-50px">
                                            <span class="symbol-label" style="background-image:url({{$user->image}});"></span>
                                        </a>
                                        <!--end::Thumbnail-->
                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1" data-kt-ecommerce-category-filter="category_name">{{$user->name}}</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{$user->role}}                                   
                                    </div>
                                </td>
                                <td>
                                    <!--begin::Badges-->
                                    <a href="#" class="btn btn-primary notify"  data-id="{{ $user->id }}"
                                        data-url="{{ url('notify') }}"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
                                        <i class="bi bi-bell fs-3"></i>
                                    </a>                          
                                </td>
                                <!--end::Category=-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">@lang('dashboard.actions')
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{route('admins.edit', $user->id)}}" class="menu-link px-3">@lang('dashboard.edit')</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-ecommerce-category-filter="delete_row" data-url="{{route('admins.destroy', $user->id)}}" data-id="{{$user->id}}">@lang('dashboard.delete')</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                            <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
					
@endsection
@section('scripts')
<script>
    $(document).on('click' , '.notify' , function (e) {
        $('.notify_id').val($(this).data('id'))
    })
</script>
<script>
    $('#kt_modal_add_customer_form').validate({
            rules: {
              "title_ar" : {
                  required : true ,
              },
                "title_en" : {
                    required : true ,
                },
                "body_ar" : {
                    required : true ,
                },
                "body_en" : {
                    required : true ,
                },
            },
            messages: {
                "title_ar" : {
                    required : "@lang('validation.required' , ['attribute' => __('dashboard.notification_title_ar')])",
                },
                "title_en" : {
                    required : "@lang('validation.required' , ['attribute' => __('dashboard.notification_title_en')])",
                },
                "body_ar" : {
                    required : "@lang('validation.required' , ['attribute' => __('dashboard.notification_body_ar')])",
                },
                "body_en" : {
                    required : "@lang('validation.required' , ['attribute' => __('dashboard.notification_body_en')])",
                },
        
            },
    
        });
    
    
</script>
<script src="{{asset('dashboard/custom/js/modal.js')}}"></script>

@endsection