<template>
    <div>
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Lista de Variantes</div>
                <div class="card-body">
                    <table class="table table-striped" v-bind:pagenumber="pagenumber">
                        <thead>
                            <tr>
                                <th scope="col">Referencia</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="variation in laravelData.data" :key="variation.id">
                                <td>{{ variation.reference }}</td>
                                <td>{{ variation.description.slice(0, 50) + "....." }}</td>
                                <td>{{ variation.price }}</td>
                            </tr>
                        </tbody>
                    </table>
                   <Bootstrap5Pagination
                        :data="laravelData"
                        @pagination-change-page="variationsList"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import axios from "axios";

export default {
    props: {
        productId: {
            type: Number,
            required: true
        }
    },
    components: {
        Bootstrap5Pagination
    },
    data() {
        return {
            laravelData: {},
            id: "",
            pagenumber: 1
        };
    },
    mounted() {
        this.variationsList();
    },
    methods: {
        variationsList(page) {
            if (this.productId)
            {
                if (typeof page === "undefined")
                    page = 1;
                
                axios
                .get("/api/variations?page=" + page +"&product_id="+this.productId)
                .then((response) => {
                    this.laravelData = response.data;
                    this.pagenumber = page;
                });
            }
        }
    }
};
</script>
