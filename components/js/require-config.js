var require = {
    baseUrl: 'components/js',
    paths: {
        'jquery': 'libs/jquery/jquery.min',
        'moment': 'libs/moment',
        'bootstrap': 'libs/bootstrap',
        'bootbox': 'locales/bootbox_locale',
        'class': 'libs/class',
        'microevent': 'libs/microevent',
        'underscore': 'libs/underscore',
        'jquery.bind-first': 'libs/jquery/jquery.bind-first',
        'jquery.plainoverlay': 'libs/jquery/jquery.plainoverlay',
        'jquery.resize': 'libs/jquery/jquery.resize',
        'jquery.validate': 'libs/jquery/jquery.validate',
        'jquery.hotkeys': 'libs/jquery/jquery.hotkeys',
        'jquery.query': 'libs/jquery/jquery.query',
        'jquery.highlight': 'libs/jquery/jquery.highlight',
        'jquery.form': 'libs/jquery/jquery.form',
        'jquery.stickytableheaders': 'libs/jquery/jquery.stickytableheaders',
        'jquery.magnific-popup': 'libs/jquery/jquery.magnific-popup',
        'jquery.maskedinput': 'libs/jquery/jquery.maskedinput',
        'jquery.popover': 'libs/jquery/jquery.popover',
        'datepicker': 'libs/bootstrap-datetimepicker.min',
        'pgui.admin_panel': 'pgui.admin_panel',
        'mootools-core': 'libs/mootools-core',
        'jquery.tmpl': 'libs/jquery/jquery.tmpl',
        'knockout': 'libs/knockout',
        'trumbowyg': 'libs/trumbowyg/trumbowyg.min',
        'trumbowyg.colors': 'libs/trumbowyg/plugins/colors/trumbowyg.colors.min'
    },
    shim: {
        'jquery.stickytableheaders': ['jquery'],
        'jquery.hotkeys': ['jquery'],
        'knockout': ['jquery.tmpl'],
        'datepicker': ['moment'],
        'bootstrap': ['jquery'],
        'trumbowyg.colors': ['trumbowyg']
    }
};
