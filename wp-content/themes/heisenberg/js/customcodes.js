(function() {
    tinymce.create('tinymce.plugins.region', {
        init : function(ed, url) {
            ed.addButton('region', {
                title : 'Region',
                image : url+'wp-content/themes/southcentral_mobile/images/region.png',
                onclick : function() {
                     ed.selection.setContent('[region]' + ed.selection.getContent() + '[/region]');

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);
})(jQuery);