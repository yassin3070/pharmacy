"use strict";
var KTDocsAdvancedForms = {
    init: function () {
        var e, n, t, c, r;
        e = document.querySelector("#kt_share_earn_link_copy_button"), n = document.querySelector("#kt_share_earn_link_input"), (t = new ClipboardJS(e)) && t.on("success", (function (t) {
            var c = e.innerHTML;
            n.classList.add("bg-success"), n.classList.add("text-inverse-success"), e.innerHTML = "Copied!", setTimeout((function () {
                e.innerHTML = c, n.classList.remove("bg-success"), n.classList.remove("text-inverse-success")
            }), 3e3), t.clearSelection()
        })), (() => {
            const e = document.querySelectorAll('[data-kt-docs-advanced-forms="interactive"]'),
                n = document.querySelector('[name="interactive_amount"]');
            e.forEach((e => {
                e.addEventListener("click", (e => {
                    e.preventDefault(), n.value = e.target.innerText
                }))
            }))
        })(), c = document.querySelector("#kt_docs_forms_advanced_interactive_slider"), r = document.querySelector("#kt_docs_forms_advanced_interactive_slider_label"), noUiSlider.create(c, {
            start: [5],
            connect: !0,
            range: {
                min: 1,
                max: 500
            }
        }), c.noUiSlider.on("update", (function (e, n) {
            r.innerHTML = Math.round(e[n]), n && (r.innerHTML = Math.round(e[n]))
        }))
    }
};
KTUtil.onDOMContentLoaded((function () {
    KTDocsAdvancedForms.init()
}));
