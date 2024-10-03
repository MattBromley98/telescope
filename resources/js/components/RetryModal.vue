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
        },
        jobName: String
    },

    data() {
        return {
            jsonContent: this.json ?? '',
            modalOpen: this.open ?? false
        };
    },

    methods: {
        redeployJob() {
            axios.post(Telescope.basePath + '/telescope-api/jobs/retry', {
                payload: this.jsonContent,
                jobType: this.jobName
            }).then(data => {
                console.log(data);
            })
        },
        closeModal() {
            this.modalOpen = false;
        }
    }
}
</script>

<template>
    <div class="modal" v-show="open" @click="closeModal">
        <div class="inner-modal bg-white p-32" @click.prevent>
            <json-editor-vue
                v-model="jsonContent"
                class="jse-theme-dark">

            </json-editor-vue>
            <div class="modal-buttons">
                <a @click="redeployJob" class="btn btn-primary">Retry Job</a>
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
