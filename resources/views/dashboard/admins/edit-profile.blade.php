@extends('dashboard.layouts.app')
@section('pageTitle' , __('dashboard.edit_profile'))

@section('style')
    <link rel="stylesheet" href="{{ asset('dashboard/custom/css/intlTelInput.css') }}">
@endsection
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
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">@lang('dashboard.update_title', ['page_title' => __('dashboard.admin')])</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">@lang('dashboard.home')</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admins.index') }}"
                            class="text-muted text-hover-primary">@lang('dashboard.admins')</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">@lang('dashboard.update', ['page_title' => __('dashboard.admin')])</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">@lang('dashboard.profile_details')</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <!--begin::Form-->
                    <form id="kt_ecommerce_add_product_form" method="POST" action="{{ route('admins.update' , auth()->user()->id)}}" class="form fv-plugins-bootstrap5 fv-plugins-framework store" 
                        data-kt-redirect="{{route('admins.index')}}" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">@lang('dashboard.image')</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url('{{ asset('dashboard/assets/media/svg/avatars/blank.svg') }}')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ auth()->user()->image }})">
                                        </div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="@lang('dashboard.choose_image')">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text"> @lang('dashboard.image_requirments')</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">@lang('dashboard.full_name')</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                            <input type="text" name="first_name"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="@lang('dashboard.first_name')" value="{{ auth()->user()->first_name }}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                            <input type="text" name="last_name"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="@lang('dashboard.last_name')" value="{{ auth()->user()->last_name }}">
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">@lang('dashboard.email')</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="email"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="@lang('dashboard.email')" value="{{ auth()->user()->email }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">@lang('dashboard.phone')</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="" data-bs-original-title="Phone number must be active"
                                        aria-label="Phone number must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="tel"  id="phone"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="@lang('dashboard.phone')" value="{{auth()->user()->phone}}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">@lang('dashboard.password')</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container password-group password-container">
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="@lang('dashboard.password')" value="">
                                        <span class="toggle-password">
                                            <i class="fas fa-eye"></i>
                                        </span> 
                                    @if($errors->has('password'))
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('password')}}</div>
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">@lang('dashboard.password_confirmation')</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container password-group password-container">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="@lang('dashboard.password_confirmation')" value="">
                                        <span class="toggle-password">
                                            <i class="fas fa-eye"></i>
                                        </span> 
                                        @if($errors->has('password_confirmation'))
                                        <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('password_confirmation')}}</div>
                                        @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">@lang('dashboard.language')</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Input-->
                                    <select name="lang" aria-label="Select a Language" data-control="select2"
                                        data-placeholder="@lang('dashboard.select_language')"
                                        class="form-select form-select-solid form-select-lg select2-hidden-accessible"
                                        data-select2-id="select2-data-13-aw3u" tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="select2-data-15-q5j0">@lang('dashboard.select_language')</option>
                                        <option {{auth()->user()->lang == "en" ? 'selected' : ""}}
                                            data-kt-flag="{{ asset('dashboard/assets/media/flags/united-states.svg') }}"
                                            value="en">English
                                        </option>
                                        <option {{auth()->user()->lang == "ar" ? 'selected' : ""}}
                                            data-kt-flag="{{ asset('dashboard/assets/media/flags/saudi-arabia.svg') }}"
                                            value="ar">العربية - Arabic
                                        </option>

                                    </select>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-0">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">@lang('dashboard.allow_notifications')</label>
                                <!--begin::Label-->
                                <!--begin::Label-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="form-check form-check-solid form-switch fv-row">
                                        <input class="form-check-input w-45px h-30px" name="is_notify" value="1"
                                            type="checkbox" id="allownotification" {{auth()->user()->is_notify ? "checked='checked'" : ""}}>
                                        <label class="form-check-label" for="allownotification"></label>
                                    </div>
                                </div>
                                <!--begin::Label-->
                            </div>
                        </div>
                        <!--end::Basic info-->

                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <!--begin::Button-->
                            <a href="{{ route('admins.index') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">@lang('dashboard.cancel')</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">@lang('dashboard.save_changes')</span>
                                <span class="indicator-progress">@lang('dashboard.please_wait')
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Card footer-->
                    </form>
                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
</div>
@endsection

@section('scripts')

    <script src="{{ asset('dashboard/custom/js/intlTelInput.js') }}"></script>

    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            preferredCountries: ["sa"],
            hiddenInput: "phone",
            separateDialCode: true,
            formatOnDisplay: false,
            utilsScript: "{{ asset('dashboard/custom/js/utils.js') }}"
        });
    </script>
    <script src="{{ asset('dashboard/custom/js/activate-account.js') }}"></script>

    <script>
        $('#kt_ecommerce_add_product_form').validate({
            rules: {

                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                "#phone": {
                    required: true
                }
            }
        })
    </script>
@endsection