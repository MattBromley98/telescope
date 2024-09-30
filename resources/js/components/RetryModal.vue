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
    <div class="modal">
        <json-editor
            v-model="jsonContent">

        </json-editor>
        <a>Retry Job</a>
    </div>
</template>

<style scoped>
.modal {
    background: black;
    opacity: 40;
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
}
</style>
