"use strict";
var KTModalCustomersAdd = function () {
    var t, e, o, n, r, i , q;
    return {
        init: function () {
           
            i = new bootstrap.Modal(document.querySelector("#kt_modal_add_mail")), 
            r = document.querySelector("#kt_modal_add_mail_form"), 
            t = r.querySelector("#kt_modal_add_mail_submit"),
            e = r.querySelector("#kt_modal_add_mail_cancel"), 
            o = r.querySelector("#kt_modal_add_mail_close"),
            
            r.addEventListener("submit", (function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData($(this)[0]),
                    dataType:'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $(".send-notify-button").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disable',true)
                    },
                    success: function(response){
                        $(".text-danger").remove()
                        $('.notify-form teaxtarea').removeClass('border-danger')
                        $(".send-notify-button").html(`${$.localize.data['app']['common']['send']}`).attr('disable',false)
                        Swal.fire({
                            text: `${$.localize.data['app']['common']['submitted']}`,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: `${$.localize.data['app']['common']['got_it']}`,
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function (e) {
                                    (t.disabled = !1, window.location = r.getAttribute("data-kt-redirect"))
                            }))
                    },
                    error: function (xhr) {
                        $(".send-notify-button").html(`${$.localize.data['app']['common']['send']}`).attr('disable',false)
                        $(".text-danger").remove()
                        $('.notify-form teaxtarea').removeClass('border-danger')
    
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('.notify-form teaxtarea[name='+key+']').addClass('border-danger')
                            $('.notify-form teaxtarea[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                            $('.notify-form select[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                        });
                    },
                });
            })), e.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: `${$.localize.data['app']['common']['check_cancel']}`,
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: `${$.localize.data['app']['common']['yes_cancel']}`,
                    cancelButtonText:  `${$.localize.data['app']['common']['no_return']}`,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then((function (t) {
                    t.value ? (r.reset(), i.hide()) : "cancel" === t.dismiss && Swal.fire({
                        text:`${$.localize.data['app']['common']['form_not_cancelled']}`,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: `${$.localize.data['app']['common']['got_it']}`,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                    $(".text-danger").remove()
                    $('.notify-form teaxtarea').removeClass('border-danger')
                }))
            })), o.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: `${$.localize.data['app']['common']['check_cancel']}`,
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: `${$.localize.data['app']['common']['yes_cancel']}`,
                    cancelButtonText: `${$.localize.data['app']['common']['no_return']}`,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then((function (t) {
                    t.value ? (r.reset(), i.hide()) : "cancel" === t.dismiss && Swal.fire({
                        text: `${$.localize.data['app']['common']['form_cancelled']}`,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: `${$.localize.data['app']['common']['got_it']}`,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                    $(".text-danger").remove()
                    $('.notify-form teaxtarea').removeClass('border-danger')
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalCustomersAdd.init()
}));
