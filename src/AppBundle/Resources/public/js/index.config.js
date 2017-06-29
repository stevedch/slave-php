(function ($) {

    'use strict';

    /**
     * @type {{init: init, attach: attach}}
     */
    var methods = {
        init: function (options) {

        },
        attach: function (options) {

        }
    };

    /**
     * @param method
     * @returns {*|HTMLElement}
     */
    $.fn.configEngine = function (method) {

        var container = $(this);
        if (!container[0]) return container;

        if ('string' === typeof method && '_' !== method.charAt(0) && methods[method]) {

            methods.init.apply(container);
            return methods[method].apply(container, Array.prototype.slice.call(arguments, 1));
        } else if ('object' !== typeof method || !method) {

            methods.init.apply(container, arguments);
            return methods.attach.apply(container);
        } else {

            $.error('Method '
                .concat(method)
                .concat(' does not exist in jQuery.configEngine'));
        }
    };

    /**
     * @type {{defaults: {attr: {isClass: boolean, options: string}}}}
     */
    $.configEngine = {
        defaults: {
            attr: {
                isClass: true,
                options: "" // string or object
            }
        }
    };

    $(function () {
        $.configEngine.defaults.init = methods.init() ? 'init' : '';
    });
})(jQuery);