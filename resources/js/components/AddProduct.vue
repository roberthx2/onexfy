<template>
    <div class="row">
        <div class="col-md-7 com-lg-7 offset-md-3">
            <validation-error-component :errors="validationErrors" v-if="validationErrors"/>
            <br>
        </div>

        <div class="col-md-7 com-lg-7 offset-md-3">
            <form
                @submit.prevent="onSubmit"
            >
                <div class="form-group">
                    <label for="title">Nombre</label>
                    <input type="text" name="title" class="form-control" placeholder="Nombre" v-model="record.name"/>
                </div>

                <div class="form-group">
                    <label for="title">Referencia</label>
                    <input type="text" name="reference" class="form-control" placeholder="Referencia" v-model="record.reference"/>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" class="form-control" placeholder="Descripción" v-model="record.description"></textarea>
                </div>

                <div class="form-group">
                    <label for="title">Precio</label>
                    <input type="number" min="0" step="0.01" name="title" class="form-control" placeholder="Precio" v-model="record.price"/>
                </div>

                <div class="col-md-12" style="padding-top: 20px;">
                    <div class="card border-primary mb-3" 
                    v-for="(variation, index) in record.variations" :key="variation.id ? variation.id : variation.key">
                        <div class="card-header align-self-end" style="background-color: white; border-color: white;">
                            <button type="button" class="btn btn-close" aria-label="Close" @click.prevent="removeVariation(index)"></button>
                        </div>
                        <div class="card-body text-primary">
                            <div class="form-group">
                                <label for="title">Referencia</label>
                                <input type="text" name="reference" class="form-control" placeholder="Referencia" v-model="variation.reference"/>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" class="form-control" placeholder="Descripción" v-model="variation.description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="title">Precio</label>
                                <input type="number" min="0" step="0.01" name="title" class="form-control" placeholder="Precio" v-model="variation.price"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <br>
                        <button @click.prevent="addVariation()" class="btn btn-secondary">
                            Agregar Variación <i class="fa-solid fa-plus"></i><div class="ripple-container"></div>
                        </button>
                </div>

                <div class="form-group text-center">
                    <br>
                    <button class="btn btn-success" :disabled="loading">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

import axios from "axios";

export default {
    props: {
        record: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            loading: false,
            validationErrors: [],
            variationDeletes: []
        };
    },
    methods: {
        addVariation() {
            this.record.variations.push({
                key: new Date().getTime() + Math.round(Math.random() * 10000),
                id: '',
                reference: '',
                description: '',
                price: ''
            });
        },
        removeVariation(index) {
            if (this.record.variations[index].id)
                this.variationDeletes.push(this.record.variations[index].id);

            this.record.variations.splice(index, 1);
        },
        onSubmit() {
            this.loading = true;
            this.validationErrors = [];
            let url = '/api/products';

            let data = new FormData();
            data.append('name', this.record.name ? this.record.name : '');
            data.append('reference', this.record.reference ? this.record.reference : '');
            data.append('description', this.record.description ? this.record.description : '');
            data.append('price', this.record.price ? this.record.price : '');

            if (this.record.id)
            {
                data.append('_method', 'put');
                url += `/${this.record.id}`;
            }

            axios.post(url, data)
                .then(response => {
                    this.loading = false;
                    
                    if (this.record.variations.length > 0 || this.variationDeletes.length > 0)
                        this.updateVariation(response.data.data)
                    else
                        this.finishForm()
                })
                .catch(error => {
                    if (error.response.status == 422)
                        this.validationErrors = error.response.data.errors;

                    this.loading = false;
                });
        },
        async updateVariation(product) {
            this.record.id = product.id;
            let hasError = false;

            await _.forIn(this.record.variations, (variation, key) => {

                let url = '/api/variations';

                let data = new FormData();
                data.append('reference', variation.reference ? variation.reference : '');
                data.append('description', variation.description ? variation.description : '');
                data.append('price', variation.price ? variation.price : '');
                data.append('product_id', product.id);

                if (variation.id)
                {
                    data.append('_method', 'put');
                    url += `/${variation.id}`;
                }

                axios.post(url, data)
                .then(response => {
                    variation.id = response.data.data.id;
                })
                .catch(error => {
                    if (error.response.status == 422)
                        this.validationErrors = error.response.data.errors;

                    this.hasError = true;
                });
            });

            await _.forIn(this.variationDeletes, (variation, key) => {

                axios.delete(`/api/variations/${variation}`)
                .then(response => {
                })
                .catch(error => {
                    this.hasError = true;
                });
            });

            if (!this.hasError)
                await this.finishForm();
        },
        finishForm() {
            this.loading = false;
            this.$emit('product-store');
        }
    }
};
</script>