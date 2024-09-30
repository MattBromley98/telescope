<script type="text/ecmascript-6">
import axios from "axios";

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
            jsonContent: this.json ?? '{test: true}'
        };
    },

    methods: {
        redeployJob() {
            axios.get(Telescope.basePath + '/telescope-api/jobs/retry').then(data => {
                console.log(data);
            })
        }
    }
}
</script>

<template>
    <div class="modal" v-if="open">
        <div class="inner-modal bg-white p-32">
            <json-editor-vue
                v-model="jsonContent"
                class="jse-theme-dark">

            </json-editor-vue>
            <div class="modal-buttons">
                <a class="btn btn-primary">Retry Job</a>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import 'vanilla-jsoneditor/themes/jse-theme-dark.css';
.modal {
    display: grid;
    place-items: center;
    visibility: visible;
    background: #00000087;
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
}

.inner-modal {
    z-index: 20;
    opacity: 1;
    background: white;
    padding: 32px;
}

.modal-buttons {
    display: grid;
    place-items: end;
    padding-top: 20px;
}
</style>
