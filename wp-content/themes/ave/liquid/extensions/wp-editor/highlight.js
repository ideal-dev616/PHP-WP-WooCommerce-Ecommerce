(function() {
    tinymce.create("tinymce.plugins.highlight_plugin", {

        //url argument holds the absolute url of our plugin directory
        init : function(ed, url) {

            //add new button    
            ed.addButton("highlight", {
                title : "Highlight",
                cmd : "highlight_command",
                image : url + '/assets/img/highlight.png'
            });

            //button functionality.
            ed.addCommand("highlight_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = "[ld_highlight]" + selected_text + "[/ld_highlight]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Highlight",
                author : "Liquid Themes",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("highlight_plugin", tinymce.plugins.highlight_plugin);
})();