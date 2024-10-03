<script type="text/ecmascript-6">
import axios from "axios";

export default {
    components: {
        'json-editor': require('json-editor-vue').default
    },

    props: {
        modalOpen: {
            type: Boolean,
            default: false
        },
        json: {
            type: String,
            default: '{}'
        },
        jobName: String
    },

    data() {
        return {
            jsonContent: this.json?.data ?? '',
        };
    },

    methods: {
        redeployJob() {
            axios.post(window.Telescope.basePath + '/jobs/retry', {
                payload: this.jsonContent,
                jobType: this.jobName
            }).then(data => {
                window.location.replace(window.Telescope.basePath + '/jobs');
            })
        },
        closeModal() {
            window.location.reload();
        }
    },
}
</script>

<template>
    <div class="modal" v-show="modalOpen" @click.self="closeModal">
        <div class="inner-modal bg-white p-32" @click.prevent>
            <json-editor-vue
                v-model="jsonContent"
                class="jse-theme-dark">

            </json-editor-vue>
            <div class="modal-buttons">
                <a @click.self="redeployJob" class="btn btn-primary">Retry Job</a>
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
    overflow-y: scroll;
    min-width: 486px;
}

.modal-buttons {
    display: grid;
    place-items: end;
    padding-top: 20px;
}
</style>
