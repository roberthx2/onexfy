<template>
    <div>
        <div v-if="validationErrors">
            <ul class="list-group">
                <li class="list-group-item list-group-item-danger" v-for="(value, key) in validationErrors" :key="key">* {{ value }}</li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        errors: {
            type: Array,
            required: true
        }
    },
    computed: {
        validationErrors() {
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    }
}
</script>
