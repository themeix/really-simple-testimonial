;(function ($) {
    $(document).ready(function () {
        $('#add-row').on('click', function () {
            var row = $('.empty-row.custom-repeter-text').clone(true);
            row.removeClass('empty-row custom-repeter-text').css('display', 'table-row');
            row.insertBefore('#repeatable-fieldset-one tbody>tr:last');
            return false;
        });

        $('.remove-row').on('click', function () {
            $(this).parents('tr').remove();
            return false;
        });
    });
}(jQuery));









