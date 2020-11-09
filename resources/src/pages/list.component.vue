<template>
    <section class="w-full px-4 py-6">
        <section v-if="!products.length" class="w-6/12 mx-auto">
            <LoadingComponent />
        </section>
        <header v-if="products.length" class="w-full mt-6">
            <h4 class="text.title:h2 font-bold color:purple">
                LISTA DE IMÓVEIS
            </h4>
        </header>
        <TableComponent
            v-if="products.length"
            v-on:update:products="getAllProducts()"
            :products="products"
        />
    </section>
</template>
<script>
import TableComponent from "../components/table.component";
import LoadingComponent from "../components/loading.component";
import Axios from "axios";

export default {
    name: "List",
    data() {
        return {
            products: []
        };
    },
    components: {
        TableComponent,
        LoadingComponent
    },
    methods: {
        getAllProducts() {
            this.products = [];
            Axios.get("/api/immobile").then(({ data }) => {
                const { response } = data;
                this.products = response;
            });
        }
    },
    mounted() {
        this.getAllProducts();
    }
};
</script>
