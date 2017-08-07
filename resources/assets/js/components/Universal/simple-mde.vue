<template>
    <textarea ref="editor"></textarea>
</template>

<script type="text/javascript">
    import simplemde from 'simplemde'

    export default {
        props: ['value'],

        mounted() {
            this.mde = new simplemde({ element: this.$refs.editor })
            this.mde.value(this.value)
            var self = this
            this.mde.codemirror.on('change', function () {
                self.$emit('input', self.mde.value())
            })
        },

        watch: {
            value(newVal) { this.mde.value(newVal) }
        },

        beforeDestroy() {
            this.mde.toTextArea()
        }
    }

</script>
