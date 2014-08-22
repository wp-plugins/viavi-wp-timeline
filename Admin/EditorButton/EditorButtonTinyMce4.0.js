(function() {
    tinymce.PluginManager.add('my_mce_button', function(editor, url) {
        editor.addButton('my_mce_button', {
            text: false,
            icon: 'WordPress-timeline-mce-icon',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Viavi WordPress Timeline',
                    body: [
                        {
                            type: 'textbox',
                            name: 'textboxName',
                            label: 'Timeline ID',
                            value: ''
                        }


                    ],
                    onsubmit: function(e) {
                        editor.insertContent('[ViaviWordPressTimeline timelineid="' + e.data.textboxName + '"]');
                    }
                });
            }
        });
    });
})();