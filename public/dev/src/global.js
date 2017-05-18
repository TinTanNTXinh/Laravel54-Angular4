/**
 * Created by xinhnguyen on 18/02/2017.
 */
(function (global) {
    global.util = {
        renderDateTimePicker: function (ids, format_code = 'DD/MM/YYYY') {
            for (let id of ids) {
                $('#' + id).datetimepicker({
                    format: format_code
                });
            }
        }
    };
})(window);

