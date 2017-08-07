<template>
    <textarea ref="editor"></textarea>
</template>

<script type="text/javascript">
    import simple from 'simplemde'
    import Auth from '../../store/auth'

    export default {
        props: ['value'],

        mounted() {
            var options = {
                uploadUrl: '/api/topics/image/uploads',
                uploadFieldName: 'image',
                urlText: "\n ![file]({filename}) \n\n",
                extraHeaders: {
                    'Authorization': `Bearer ${Auth.state.api_token}`
                }

            };

            this.mdEditor = new simple({
                element: this.$refs.editor,
                spellChecker: false,
                toolbar: false,
                forceSync: true,
            });

            this.mdEditor.value(this.value)

            inlineAttachment.editors.codemirror4.attach(this.mdEditor.codemirror, options);

            var self = this
            this.mdEditor.codemirror.on('change', function () {
                self.$emit('input', self.mdEditor.value())
            })
        },

    }

</script>
