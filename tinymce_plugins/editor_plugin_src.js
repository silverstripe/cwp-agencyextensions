(function() {

  var each = tinymce.each;

  // TinyMCE will stop loading if it encounters non-existent external script file
  // when included through tiny_mce_gzip.php. Only load the external lang package if it is available.
  var availableLangs = ['en', 'mi_NZ'];
  if (jQuery.inArray(tinymce.settings.language, availableLangs) != -1) {
    tinymce.PluginManager.requireLangPack("ssicons");
  }

  /**
   * Load via:
   * HtmlEditorConfig::get('cms')->enablePlugins(array('ssmacron', '../../../agency-extensions/tinymce_plugins/editor_plugin_src.js'))
   * HtmlEditorConfig::get('cms')->insertButtonsAfter ('ssmacron', 'ssicons');
   */
  tinymce.create('tinymce.plugins.ssicons', {

    init : function(ed, url) {

      // Register commands
      ed.addCommand('mceInsertIcons', function() {
        ed.windowManager.open({
          file : url + '/icon.htm',
          width : 450 + parseInt(ed.getLang('advanced.iconmap_delta_width', 0)),
          height : 190 + parseInt(ed.getLang('advanced.iconmap_delta_height', 0)),
          inline : true
        },{
          plugin_url : url
        });
      });

      // Register buttons
      ed.addButton('ssicons', {
        title: 'Insert an Icon',
        cmd : 'mceInsertIcons',
        image : url + '../../../agency-extensions/tinymce_plugins/img/icon.png'
      });

    },

    getInfo : function() {
      console.log('getinfo');
      return {
          longname : 'Button to insert icons',
      };
    }

  });

  tinymce.PluginManager.add("ssicons", tinymce.plugins.ssicons);

})();
