import './bootstrap';

import {createApp} from 'vue'
import { Bootstrap5Pagination } from 'laravel-vue-pagination';

//import axios from 'axios'

const app = createApp({});

app.use(Bootstrap5Pagination)

import listComponent from '@/components/List.vue';
app.component('list-component', listComponent);

import addProductComponent from '@/components/AddProduct.vue';
app.component('add-product-component', addProductComponent);

import validationError from '@/components/ValidationError.vue';
app.component('validation-error-component', validationError);

//app.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr("content");

//axios.defaults.baseURL = 'http://localhost:8000/api/';

app.mount('#app');
