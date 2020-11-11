<template>
    <section class="w-full">
        <section class="table.header w-full rounded-lg mt-6">
            <section
                class="table.tr items-center w-full flex flex-wrap py-2 px-4"
            >
                <div class="lg:w-3/12 w-6/12">
                    <p
                        v-if="!sortEmailActive"
                        v-on:click="sortByEmail"
                        class="table.filter text:p color:lead font-bold"
                    >
                        E-mail do Proprietário
                        <i class="fa fa-sort"></i>
                    </p>
                    <p
                        v-if="sortEmailActive"
                        v-on:click="sortByEmail"
                        class="table.filter text:p color:blue font-bold"
                    >
                        E-mail do Proprietário
                        <i class="fa fa-sort"></i>
                    </p>
                </div>
                <div class="lg:w-4/12 w-6/12">
                    <p
                        v-if="!sortAddressActive"
                        v-on:click="sortByAddress"
                        class="table.filter text:p color:lead font-bold"
                    >
                        Endereço
                        <i class="fa fa-sort"></i>
                    </p>
                    <p
                        v-if="sortAddressActive"
                        v-on:click="sortByAddress"
                        class="table.filter text:p color:blue font-bold"
                    >
                        Endereço
                        <i class="fa fa-sort"></i>
                    </p>
                </div>
                <div class="w-3/12 lg:block hidden">
                    <p class="text:p color:lead font-bold">
                        Status
                    </p>
                </div>
            </section>
        </section>
        <section class="table w-full rounded-lg">
            <section
                v-for="(product, index) in listOfProducts"
                :key="`imovel-${index}`"
                class="table.tr items-center w-full flex flex-wrap py-4 px-4"
            >
                <div class="lg:w-3/12 w-full">
                    <p class="text:p color:blue font-bold">
                        {{ product.email }}
                    </p>
                </div>
                <div class="lg:w-4/12 w-full">
                    <p class="text:p">
                        {{ product.address }}, {{ product.number }},
                        {{ product.neighborhood }}, {{ product.city }},
                        {{ product.state }}
                    </p>
                </div>
                <div class="lg:w-3/12 w-full">
                    <p v-if="!product.solded" class="text:p color:purple">
                        Não contratado
                    </p>
                    <a
                        :href="'/api/contract/' + product.contract.id"
                        target="_blank"
                        v-if="product.solded"
                        class="text:p color:green"
                    >
                        Contratado <i class="fa fa-link"></i>
                    </a>
                </div>
                <div class="lg:w-2/12 w-full px-1 lg:text-center">
                    <button
                        v-on:click="dropAProduct(product.id)"
                        class="text:p color:red"
                    >
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </section>
        </section>
    </section>
</template>
<script>
import Axios from "axios";

export default {
    name: "Table",
    data() {
        return {
            sortEmailActive: false,
            sortAddressActive: false,
            listOfProducts: []
        };
    },
    props: {
        products: Array
    },
    methods: {
        sortByEmail() {
            if (this.sortAddressActive) {
                this.sortByAddressDisabled();
            }
            if (this.sortEmailActive) {
                this.sortByEmailDisabled();
                return;
            }
            this.sortEmailActive = true;
            const emailsSorted = this.products
                .map(v => v.email + "|" + v.id)
                .sort();
            const result = emailsSorted.map(v => {
                return this.products.filter(
                    product =>
                        product.email === v.split("|")[0] &&
                        product.id === parseInt(v.split("|")[1])
                )[0];
            });
            this.listOfProducts = result;
        },
        sortByAddress() {
            if (this.sortEmailActive) {
                this.sortByEmailDisabled();
            }

            if (this.sortAddressActive) {
                this.sortByAddressDisabled();
                return;
            }
            this.sortAddressActive = true;
            const addressSorted = this.products
                .map(
                    v =>
                        `${v.address},${v.number},${v.neighborhood},${v.city},${v.state}|${v.id}`
                )
                .sort();
            const result = addressSorted.map(v => {
                return this.products.filter(
                    product =>
                        `${product.address},${product.number},${product.neighborhood},${product.city},${product.state}` ===
                            v.split("|")[0] &&
                        product.id === parseInt(v.split("|")[1])
                )[0];
            });
            this.listOfProducts = result;
        },
        resetProducts() {
            this.listOfProducts = [...this.products];
        },
        sortByEmailDisabled() {
            this.sortEmailActive = false;
            this.resetProducts();
        },
        sortByAddressDisabled() {
            this.sortAddressActive = false;
            this.resetProducts();
        },
        dropAProduct(id) {
            Axios.delete("/api/immobile/" + id).then(response => {
                this.$emit("update:products", true);
            });
        }
    },
    mounted() {
        this.listOfProducts = [...this.products];
    }
};
</script>
<style>
.table {
    border: solid 0.25px var(--color-gray);
}

.table\.tr:not(:last-child) {
    border-bottom: solid 0.25px var(--color-gray);
}

.table\.filter {
    cursor: pointer;
}
</style>
