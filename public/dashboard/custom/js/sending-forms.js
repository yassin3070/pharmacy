$(document).ready(function(){
    const t = document.getElementById("kt_ecommerce_add_product_form"),
    o = document.getElementById("kt_ecommerce_add_product_submit");
        $(document).on('submit','.store',function(e){
            e.preventDefault();
            var url = $(this).attr('action')
            $.ajax({
                url: url,
                method: 'post',
                data: new FormData($(this)[0]),
                dataType:'json',
                processData: false,
                contentType: false,
               success: function(response){
               o.setAttribute("data-kt-indicator", "on"), o.disabled = !0, setTimeout((function () {
               o.removeAttribute("data-kt-indicator")
                Swal.fire({
                    text: `${$.localize.data['app']['common']['submitted']}`,
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: `${$.localize.data['app']['common']['got_it']}`,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then((function (e) {
                   (o.disabled = !1, window.location = t.getAttribute("data-kt-redirect"))
                }))
                }), 2e3)
                },
                error: function (xhr) {
                    Swal.fire({
                        html: `${$.localize.data['app']['common']['general_error']}`,
                        icon: `${$.localize.data['app']['common']['error']}`,
                        buttonsStyling: !1,
                        confirmButtonText: `${$.localize.data['app']['common']['got_it']}`,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                    $(".nav-link").removeClass('error-tab');
                    $(".text-danger").remove();
                    $('.store').find('input').removeClass('border-danger');
                    $('.store').find('textarea').removeClass('border-danger');
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        var ar_item  =  key.includes('.ar') ?  key.replace(".ar", "[ar]") : key;
                        var en_item  =  key.includes('.en') ?  key.replace(".en", "[en]") : key;
                        if(ar_item != en_item)
                        {
                            showTabPaneError($('.store input[name="' + en_item + '"]'));
                            showTabPaneError($('.store input[name="' + ar_item + '"]'));
                            showTabPaneError($('.store select[name="' + ar_item + '"]'));
                            showTabPaneError($('.store select[name="' + en_item + '"]'));
                            showTabPaneError($('.store textarea[name="' + ar_item + '"]'));
                            showTabPaneError($('.store textarea[name="' + en_item + '"]'));

                            $('.store input[name="' + ar_item + '"]').addClass('border-danger')
                            $('.store input[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                            $('.store input[name="' + en_item + '"]').addClass('border-danger')
                            $('.store input[name="' + en_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                           
                            $('.store select[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                            $('.store select[name="' + en_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
    
                            $('.store textarea[name="' + ar_item + '"]').addClass('border-danger')
                            $('.store textarea[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                            $('.store textarea[name="' + en_item + '"]').addClass('border-danger')
                            $('.store textarea[name="' + en_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                       
                            $('.store input[name="' + ar_item + '"]').on('input', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store input[name="' + ar_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                            $('.store input[name="' + en_item + '"]').on('input', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store input[name="' + en_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab")
                            });

                            $('.store select[name="' + ar_item + '"]').on('change', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store select[name="' + ar_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                            $('.store select[name="' + en_item + '"]').on('change', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store select[name="' + en_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                            $('.store textarea[name="' + ar_item + '"]').on('input', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store textarea[name="' + ar_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                            $('.store textarea[name="' + en_item + '"]').on('input', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store textarea[name="' + en_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                        }else{
                            showTabPaneError($('.store input[name="' + ar_item + '[]"]'));
                            showTabPaneError($('.store input[name="' + ar_item + '"]'));
                            $('.store input[name="' + ar_item + '"]').addClass('border-danger')
                            $('.store input[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                        
                            $('.store select[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                            $('.store select[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
    
                            $('.store textarea[name="' + ar_item + '"]').addClass('border-danger')
                            $('.store textarea[name="' + ar_item + '"]').after(`<span class="mt-5 text-danger">${value}</span>`);
                       
                       
                            $('.store input[name="' + ar_item + '"]').on('input', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store input[name="' + en_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab")
                            });

                            $('.store select[name="' + ar_item + '"]').on('change', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store select[name="' + ar_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                            $('.store textarea[name="' + ar_item + '"]').on('input', function() {
                                $(this).removeClass('border-danger');                            
                                $(this).siblings('.text-danger').remove();                            
                                var tabPaneId = $('.store textarea[name="' + ar_item + '"]').closest(".tab-pane").attr('id');
                                $('[href="#' + tabPaneId + '"]').removeClass("error-tab");
                            });

                        }

                        
                       
                    });
                }
            });
        });


        function showTabPaneError(element = null)
        {
            if(element)
            {
                var tabPaneId = element.closest(".tab-pane").attr('id');
                $('[href="#' + tabPaneId + '"]').addClass("error-tab");
               
            }else{
                $('.tab-pane').each(function(){
                    if($(this).find('.text-danger').length > 0)
                    {
                        var tabPaneId = $(this).attr('id');
                        $('[href="#' + tabPaneId + '"]').addClass("error-tab")
                        $(this).find('.nav-link').addClass('error-tab');
                    }
                });
            }
        }

});


