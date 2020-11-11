<template>
    <section class="w-full px-4 py-6">
        <section class="w-full">
            <header class="w-full mx-auto my-6">
                <h4 class="text.title:h2 font-bold color:purple">
                    NOVO CONTRATO
                </h4>
            </header>
            <section class="w-full">
                <ProductsComponent />
            </section>
        </section>
    </section>
</template>
<script>
import ProductsComponent from "../components/products.component";

export default {
    name: "Contract",
    components: {
        ProductsComponent
    }
};
</script>
