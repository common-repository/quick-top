jQuery(document).ready(function($) {
    $('#quick_top_live_preview').on('input change', 'input, select', function() {
        var formData = $('#quick_top_live_preview').serializeArray();
        var settings = {};
        $.each(formData, function(_, field) {
            settings[field.name] = field.value;
        });

        var preview = $('#quick-top-preview');
        preview.css({
            'background-color': settings['quick_top_settings[icon_bg_color]'],
            'color': settings['quick_top_settings[icon_color]'],
            'font-size': settings['quick_top_settings[icon_size]'] + 'px',
            'width': settings['quick_top_settings[bg_width]'] + 'px',
            'height': settings['quick_top_settings[bg_height]'] + 'px',
            'padding': settings['quick_top_settings[padding]'] + 'px',
            'margin-top': settings['quick_top_settings[margin_top]'] + 'px',
            'margin-right': settings['quick_top_settings[margin_right]'] + 'px',
            'margin-bottom': settings['quick_top_settings[margin_bottom]'] + 'px',
            'margin-left': settings['quick_top_settings[margin_left]'] + 'px',
            'border-radius': settings['quick_top_settings[border_radius]'] + 'px',
        });
        preview.find('i').removeClass().addClass('fa ' + settings['quick_top_settings[icon]']);
    });
});
