<template>
    <section class="w-full px-4 py-6">
        <form class="w-full">
            <header class="w-full mx-auto my-6">
                <h4 class="text.title:h2 font-bold color:purple">
                    NOVO CONTRATO
                </h4>
            </header>
            <section v-if="!$route.params.id" class="w-full">
                <ProductsComponent />
            </section>
            <section v-if="$route.params.id" class="w-full">
                <section class="w-full mx-auto flex flex-wrap my-2">
                    <div class="w-6/12 pr-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Cidade"
                            type="text"
                            value="Guarulhos"
                            disabled
                        />
                    </div>
                    <div class="w-6/12 pl-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Bairro"
                            type="text"
                            disabled
                            value="JD. Vermelhão"
                        />
                    </div>
                </section>
                <section class="w-full mx-auto flex flex-wrap my-2">
                    <div class="w-8/12 pr-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Endereço"
                            type="text"
                            disabled
                            value="R. Pernambuco"
                        />
                    </div>
                    <div class="w-4/12 pl-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Número"
                            type="text"
                            disabled
                            value="1238"
                        />
                    </div>
                </section>
                <input
                    class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                    placeholder="Complemento"
                    type="text"
                    disabled
                    value="Próximo ao Supermercado"
                />
                <section
                    class="w-full mx-auto flex flex-wrap my-2 items-center"
                >
                    <div class="w-6/12 pr-1">
                        <input
                            class="input:checkbox hidden"
                            id="persontype"
                            type="checkbox"
                        />
                        <label
                            class="input:checkbox.label flex flex-wrap px-4 py-2 rounded-lg"
                            for="persontype"
                        >
                            <div
                                class="input:checkbox.canvas mx-1 relative rounded-full"
                            >
                                <div
                                    class="input:checkbox.icons absolute my-auto bottom-0 top-0 rounded-full"
                                ></div>
                            </div>
                            <span
                                class="input:checkbox.title text:p color:lead"
                            >
                                Pessoa Juridica
                            </span>
                        </label>
                    </div>
                    <div class="w-6/12 pl-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="CPF"
                            type="text"
                        />
                    </div>
                </section>
                <input
                    class="input w-full mx-auto my-2 px-4 py-2 text:p block rounded-lg"
                    placeholder="E-mail"
                    type="text"
                />
                <input
                    class="input w-full mx-auto my-2 px-4 py-2 text:p block rounded-lg"
                    placeholder="Nome Completo"
                    type="text"
                />
                <footer class="w-full mx-auto">
                    <button
                        class="btn.success text:p my-2 color:green px-6 py-2 rounded-lg font-light"
                    >
                        CADASTRAR CONTRATO
                    </button>
                </footer>
            </section>
        </form>
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
