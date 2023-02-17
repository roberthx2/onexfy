<template>
    <div id="postsrec">
        <div class="row">
            <div class="postAdd col-lg-12 text-right" style="margin-bottom: 20px;">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduct" 
                @click="addProduct()">Agregar Producto</button>
            </div>
        </div>   
        <div class="row justify-content-center">
            <div v-bind:class="{ succmsg: succmsg }">
                <div class="col-md-12 col-lg-12">
                    <div class="alert alert-success cusmsg">{{ actionmsg }}</div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Lista de Productos</div>
                    <div class="card-body">
                        <table class="table table-striped" v-bind:pagenumber="pagenumber">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col" colspan="3">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in laravelData.data" :key="product.id">
                                    <th scope="row">{{ product.name }}</th>
                                    <td>{{ product.reference }}</td>
                                    <td>{{ product.description.slice(0, 50) + "....." }}</td>
                                    <td>{{ product.price }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduct" @click="editProduct(product.id)" :title="product.name">Editar</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalVariations" @click="assignId(product.id)">Variaciones</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="assignId(product.id)">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <Bootstrap5Pagination
                            :data="laravelData"
                            @pagination-change-page="productList"
                        />
                    </div>
                </div>

                <ModalComponent 
                    ref="modalDelete"
                    id="modalDelete"
                    title="Eliminar Producto"
                    @acceptModal="deleteProduct"
                >
                    <template #body>¿Esta seguro de eliminar este producto?</template>
                </ModalComponent>

                <ModalComponent 
                    ref="modalVariations"
                    id="modalVariations"
                    title="Variantes"
                    :showAcceptBtn="false"
                    sizeClass="modal-lg"
                >
                    <template #body><ListProductVariants :productId="id" :key="id"/></template>
                </ModalComponent>

                <ModalComponent 
                    ref="modalProduct"
                    id="modalProduct"
                    title="Producto"
                    :showAcceptBtn="false"
                    sizeClass="modal-fullscreen"
                >
                    <template #body>
                        <addProduct ref="addProduct" :record="product" @productStore="showMsgProduct"/>
                    </template>
                </ModalComponent>

            </div>
        </div>
    </div>
</template>

<script>

import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import axios from "axios";
import ModalComponent from './ModalComponent.vue';
import ListProductVariants from './ListProductVariants.vue';
import addProduct from './AddProduct.vue';

export default {
    components: {
        Bootstrap5Pagination,
        ModalComponent,
        ListProductVariants,
        addProduct
    },
    data() {
        return {
            product: {
                id: '',
                name: '',
                reference: '',
                description: '',
                price: '',
                variations: []
            },
            laravelData: {},
            id: 0,
            succmsg: true,
            showmodal: false,
            pagenumber: 1,
            actionmsg: "",
        };
    },
    mounted() {
        this.productList();
    },
    methods: {
        productList(page) {
            if (typeof page === "undefined")
                page = 1;
            
            axios
            .get("/api/products?page=" + page)
            .then((response) => {
                this.laravelData = response.data;
                this.pagenumber = page;
            });
        },
        assignId(id) {
            this.id = id;
        },
        deleteProduct() {
            axios
            .delete("/api/products/" + this.id)
            .then((data) => {
                this.succmsg = false;
                var self = this;

                setTimeout(function () {
                    self.succmsg = true;
                }, 3000);

                this.actionmsg = "Registro Eliminado Correctamente";
                this.productList(this.pagenumber);
                this.$refs.modalDelete.closeModal();
            });
        },
        editProduct(id) {
            axios
            .get("api/products/" + id)
            .then((response) => {
                this.product = response.data.data;
            });
        },
        addProduct() {
            this.product = {
                id: '',
                name: '',
                reference: '',
                description: '',
                price: '', 
                variations: []
            }
        },
        showMsgProduct() {
            this.succmsg = false;

            setTimeout(function () {
                self.succmsg = true;
            }, 3000);

            this.actionmsg = "Información almacenada correctamente";
            this.productList(this.pagenumber);
            this.$refs.modalProduct.closeModal();
        }
    }
};
</script>

<style scoped>
.succmsg {
  display: none;
}
.showmodal {
  display: none !important;
  opacity: 0;
}
</style>
