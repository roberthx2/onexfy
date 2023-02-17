<template>
    <div class="modal fade" :id="id" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true" ref="modalComponet">
        <div :class="`modal-dialog ${sizeClass}`">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">{{ title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot name="body"></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeModal()">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="acceptModal()" v-if="showAcceptBtn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Modal } from 'bootstrap';

export default {
    props: {
        id: {
            type: String,
            required: true
        },
        title: {
            type: String,
            default: ''
        },
        showAcceptBtn: {
            type: Boolean,
            default: true
        },
        sizeClass: {
            type: String,
            default: ''
        }
    },
    methods: {
        toogleModal(state) {
            if (state)
                Modal.getInstance(this.$refs.modalComponet).show()
            else
                Modal.getInstance(this.$refs.modalComponet).hide()
        },
        openModal() {
            this.toogleModal(true)
        },
        closeModal() {
            this.toogleModal(false)
        },
        acceptModal() {
            this.$emit('accept-modal');
        }
    }
}
</script>
