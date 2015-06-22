/*global jQuery*/
/*jslint plusplus: true*/
(function ($) {
    'use strict';

    var app = {
        $inputs: $('.js-name, .js-gender, .js-birthday, .js-phone'),
        init: function () {
            this.$inputs
                .keypress($.proxy(this.onChange, this))
                .change($.proxy(this.onChange, this));

            this.$inputs.filter('.js-birthday')
                .mask('99.99.9999')
                .datepicker({
                    dateFormat: 'dd.mm.yy'
                });
            this.$inputs.filter('.js-phone')
                .mask('8 (999) 999-99-99');

            $('.js-form').submit($.proxy(this.onSubmit, this));

            $('#modalConfirmDelete').on('show.bs.modal', function (e) {
                $(this).find('.js-modal-btn-delete')
                    .attr('href', $(e.relatedTarget).data('href'));
            });

            this.$inputs.filter('[title]')
                .closest('.form-group').addClass('has-error');
            this.$inputs
                .tooltip({
                    trigger: 'manual'
                })
                .tooltip('show');
        },

        onChange: function (e) {
            this.hideError($(e.target));
        },
        onSubmit: function (e) {
            var i;
            $('.alert').alert('close');

            for (i = 0; i < this.$inputs.length; i++) {
                if (!this.validateRequired(this.$inputs.eq(i),
                        'Поле обязательно для заполнения')) {
                    e.preventDefault();
                    return;
                }
            }
        },

        validateRequired: function ($input, msg) {
            if (!$input.val().trim()) {
                this.showError($input, msg);
                $input.focus();
                return false;
            }
            return true;
        },

        hideError: function ($elem) {
            $elem.attr('title', '')
                .tooltip('fixTitle').tooltip('hide');
            $elem.closest('.form-group').removeClass('has-error');
        },
        showError: function ($elem, msg) {
            $elem.attr('title', msg)
                .tooltip('fixTitle').tooltip('show');
            $elem.closest('.form-group').addClass('has-error');
        }
    };
    app.init();
}(jQuery));