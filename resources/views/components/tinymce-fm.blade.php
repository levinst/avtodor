<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-init="
        tinymce.init({
            path_absolute : '/',
            target: $refs.tinymce,
            themes: 'modern',
            height: 400,
            menubar: false,
            language: 'ru',
            relative_urls: false,
            remove_script_host: true,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table directionality',
                'emoticons template paste textpattern'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | table | bullist numlist outdent indent | link image media | code removeformat',
            file_picker_callback (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

                var cmsURL = '/file-manager/tinymce5/?leftDisk=';
                if (meta.filetype == 'image') {
                  cmsURL = cmsURL + 'images';
                } else {
                  cmsURL = cmsURL + 'files';
                }


                tinymce.activeEditor.windowManager.openUrl({
                  url : cmsURL,
                  title : 'Файлы',
                  width : x * 0.8,
                  height : y * 0.8,
                  onMessage: (api, message) => {
                    callback(message.content, { text: message.text })
                  }
                })
            },
            setup: function(editor) {
                editor.on('blur', function(e) {
                    value = editor.getContent()
                })

                editor.on('init', function (e) {
                    if (value != null) {
                        editor.setContent(value)
                    }
                })

                function putCursorToEnd() {
                    editor.selection.select(editor.getBody(), true);
                    editor.selection.collapse(false);
                }

                $watch('value', function (newValue) {
                    if (newValue !== editor.getContent()) {
                        editor.resetContent(newValue || '');
                        putCursorToEnd();
                    }
                });
            }
        })
    "
    wire:ignore
>
    <div>
        <input
            x-ref="tinymce"
            type="textarea"
            rows="6"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        >
    </div>
</div>
