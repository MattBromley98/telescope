<script type="text/ecmascript-6">
export default {
    components: {
        'json-editor': require('json-editor-vue').default
    },

    props: {
        open: {
            type: Boolean,
            default: false
        },
        json: {
            type: String,
            default: '{}'
        }
    },

    data() {
        return {
            jsonContent: this.json ?? '{}'
        };
    }
}
</script>

<template>
    <div class="bg-black opacity-40 fixed inset-0 w-full h-full">
        <json-editor
            v-model="jsonContent">

        </json-editor>
        <a>Retry Job</a>
    </div>
</template>

<style scoped>

</style>
