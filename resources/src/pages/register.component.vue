<template>
    <section class="w-full px-4 py-6 relative">
        <section class="bg-white mx-auto rounded-lg">
            <form @submit="saveImmobile" class="w-full">
                <header class="w-full mx-auto my-6">
                    <h4 class="text.title:h2 font-bold color:purple">
                        CADASTRAR NOVO IMÓVEL
                    </h4>
                </header>
                <section class="w-full">
                    <input
                        class="input w-full mx-auto px-4 py-2 my-2 text:p block rounded-lg"
                        placeholder="E-mail do proprietário."
                        required
                        type="email"
                        v-model="immobile.email"
                    />
                    <section class="w-full mx-auto flex flex-wrap my-2">
                        <div class="w-6/12 pr-1">
                            <input
                                class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                                placeholder="CEP"
                                id="cep"
                                required
                                v-model="immobile.CEP"
                                v-on:change="searchAddressByCep"
                                type="text"
                            />
                        </div>
                        <div class="w-6/12 pl-1">
                            <select
                                class="input w-full mx-auto px-4 py-2 text:p block rounded-lg bg-white"
                                v-model="immobile.state"
                            >
                                <option disabled selected value="">
                                    Estado
                                </option>
                                <option
                                    v-for="(state, index) in states"
                                    :key="index"
                                    :value="state"
                                >
                                    {{ state }}
                                </option>
                            </select>
                        </div>
                    </section>
                    <section class="w-full mx-auto flex flex-wrap my-2">
                        <div class="w-8/12 pr-1">
                            <input
                                class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                                placeholder="Endereço"
                                v-model="immobile.address"
                                required
                                type="text"
                            />
                        </div>
                        <div class="w-4/12 pl-1">
                            <input
                                class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                                placeholder="Número"
                                v-model="immobile.number"
                                required
                                type="text"
                            />
                        </div>
                    </section>
                    <section class="w-full mx-auto flex flex-wrap my-2">
                        <div class="w-6/12 pr-1">
                            <input
                                class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                                placeholder="Cidade"
                                v-model="immobile.city"
                                required
                                type="text"
                            />
                        </div>
                        <div class="w-6/12 pl-1">
                            <input
                                class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                                placeholder="Bairro"
                                v-model="immobile.neighborhood"
                                required
                                type="text"
                            />
                        </div>
                    </section>
                    <section class="w-full mx-auto flex flex-wrap my-2">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Complemento"
                            v-model="immobile.complement"
                            type="text"
                        />
                    </section>
                    <section
                        v-if="errors.length"
                        class="w-full my-2 bg-red py-2 px-4 rounded-lg"
                    >
                        <p v-for="error in errors" class="text:p font-bold">
                            <i class="fa fa-warning"></i> - {{ error }}
                        </p>
                    </section>
                    <footer class="w-full mx-auto flex flex-wrap items-center">
                        <button
                            :disabled="sendInProgress"
                            class="btn.success text:p my-2 color:green px-6 py-2 rounded-lg font-light"
                        >
                            CADASTRAR IMÓVEL
                        </button>
                    </footer>
                </section>
            </form>
        </section>
    </section>
</template>
<script>
import Axios from "axios";
import VMask from "vanilla-masker";
import EmailValidator from "email-validator";

export default {
    name: "LoginPage",
    data() {
        return {
            states: [
                "AC",
                "AL",
                "AM",
                "AP",
                "BA",
                "CE",
                "DF",
                "ES",
                "GO",
                "MA",
                "MT",
                "MS",
                "MG",
                "PA",
                "PB",
                "PR",
                "PE",
                "PI",
                "RJ",
                "RN",
                "RO",
                "RS",
                "RR",
                "SC",
                "SE",
                "SP",
                "TO"
            ],
            immobile: {
                email: "",
                CEP: "",
                state: "",
                address: "",
                number: "",
                city: "",
                neighborhood: "",
                complement: ""
            },
            errors: [],
            sendInProgress: false
        };
    },
    methods: {
        searchAddressByCep() {
            const cep = this.immobile.CEP;
            Axios.get(`https://viacep.com.br/ws/${cep}/json/`).then(
                ({ data }) => {
                    const {
                        bairro,
                        uf,
                        complemento,
                        localidade,
                        logradouro
                    } = data;

                    this.immobile.state = uf;
                    this.immobile.address = logradouro;
                    this.immobile.city = localidade;
                    this.immobile.neighborhood = bairro;
                    this.immobile.complement = complemento;
                }
            );
        },
        saveImmobile(e) {
            e.preventDefault();
            const Form = new FormData();

            if (!EmailValidator.validate(this.immobile.email)) {
                this.immobile.email = "";
                this.errors.push(`E-mail inválido!`);
            }

            if (this.errors.length) return;
            this.errors = [];
            for (let index in this.immobile) {
                Form.append(index, this.immobile[index]);
            }

            this.sendInProgress = true;

            Axios.post("/api/immobile", Form)
                .then(({ data }) => {
                    this.$router.push("/imoveis");
                })
                .catch(response => {
                    console.log(response);
                });
        }
    },
    mounted() {
        VMask(document.getElementById("cep")).maskPattern("99999-999");
    }
};
</script>
