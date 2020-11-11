<template>
    <section class="w-full px-4 py-6">
        <section v-if="uiConfig.loading" class="w-6/12 mx-auto">
            <LoadingComponent />
        </section>
        <section
            v-if="errors.length"
            class="w-full px-4 py-2 rounded-lg bg-red"
        >
            <p
                class="text:p font-bold color-lead"
                v-for="(error, index) in errors"
                :key="'error-' + index"
            >
                <i class="fa fa-warning"></i> {{ error }}
            </p>
        </section>
        <form
            @submit="saveContract"
            v-if="!errors.length && !uiConfig.loading"
            class="w-full"
        >
            <header class="w-full mx-auto my-6">
                <h4 class="text.title:h2 font-bold color:purple">
                    NOVO CONTRATO
                </h4>
            </header>
            <section class="w-full">
                <section class="w-full mx-auto flex flex-wrap my-2">
                    <div class="w-6/12 pr-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Cidade"
                            type="text"
                            disabled
                            v-model="contract.city"
                        />
                    </div>
                    <div class="w-6/12 pl-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Bairro"
                            type="text"
                            disabled
                            value="JD. Vermelhão"
                            v-model="contract.neighborhood"
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
                            v-model="contract.address"
                            value="R. Pernambuco"
                        />
                    </div>
                    <div class="w-4/12 pl-1">
                        <input
                            class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                            placeholder="Número"
                            type="text"
                            disabled
                            v-model="contract.number"
                        />
                    </div>
                </section>
                <input
                    class="input w-full mx-auto px-4 py-2 text:p block rounded-lg"
                    placeholder="Complemento"
                    type="text"
                    disabled
                    v-model="contract.complement"
                />
                <section
                    class="w-full mx-auto flex flex-wrap my-2 items-center"
                >
                    <div class="w-6/12 pr-1">
                        <input
                            class="input:checkbox hidden"
                            id="persontype"
                            v-model="uiConfig.legalPerson"
                            type="checkbox"
                            v-on:change="changeMaskToDocumentInput"
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
                            :placeholder="uiConfig.legalPerson ? 'CNPJ' : 'CPF'"
                            type="text"
                            id="cpf"
                            required
                            v-on:keydown="loadFirstMask"
                            v-model="contract.document"
                        />
                    </div>
                </section>
                <input
                    class="input w-full mx-auto my-2 px-4 py-2 text:p block rounded-lg"
                    placeholder="E-mail"
                    v-model="contract.email"
                    required
                    type="text"
                />
                <input
                    class="input w-full mx-auto my-2 px-4 py-2 text:p block rounded-lg"
                    placeholder="Nome Completo"
                    type="text"
                    required
                    v-model="contract.name"
                />
                <section
                    v-if="uiConfig.errors.length"
                    class="w-full px-4 py-2 rounded-lg bg-red"
                >
                    <p
                        class="text:p font-bold color-lead"
                        v-for="(error, index) in uiConfig.errors"
                        :key="'error-' + index"
                    >
                        <i class="fa fa-warning"></i> {{ error }}
                    </p>
                </section>
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
import LoadingComponent from "../components/loading.component";

import Axios from "axios";
import VMask from "vanilla-masker";
import { cpf, cnpj } from "cpf-cnpj-validator";
import EmailValidator from "email-validator";

export default {
    name: "Contract",
    data() {
        return {
            immobile: undefined,
            uiConfig: {
                legalPerson: false,
                masksLoaded: false,
                loading: true,
                errors: []
            },
            errors: [],
            contract: {
                idImmobile: "",
                city: "",
                neighborhood: "",
                address: "",
                complement: "",
                number: "",
                person: "",
                document: "",
                email: "",
                personType: "",
                name: ""
            }
        };
    },
    methods: {
        setDatasForContract() {
            const {
                id,
                city,
                neighborhood,
                address,
                complement,
                number
            } = this.immobile;

            this.contract.idImmobile = id;
            this.contract.city = city;
            this.contract.neighborhood = neighborhood;
            this.contract.address = address;
            this.contract.complement = complement;
            this.contract.number = number;
        },
        getImmobile() {
            this.uiConfig.loading = true;
            Axios.get(`/api/immobile/${this.$route.params.id}`).then(
                ({ data }) => {
                    const { response } = data;
                    this.immobile = response;
                    this.setDatasForContract();
                    this.uiConfig.loading = false;
                },
                error => {
                    const { data } = error.response;
                    this.uiConfig.loading = false;
                    switch (data.status) {
                        case 404:
                            this.errors.push("Este produto não existe!");
                            break;
                        case 409:
                            this.errors.push(
                                "Este produto já está sob um contrato!"
                            );
                            break;
                    }
                }
            );
        },
        loadFirstMask() {
            if (!this.uiConfig.masksLoaded) {
                this.uiConfig.masksLoaded = true;
                VMask(document.getElementById("cpf")).maskPattern(
                    "999.999.999-99"
                );
            }
        },
        changeMaskToDocumentInput() {
            this.contract.document = "";
            if (!this.uiConfig.masksLoaded) {
                this.uiConfig.masksLoaded = true;
            }
            if (this.uiConfig.legalPerson) {
                VMask(document.getElementById("cpf")).unMask();
                VMask(document.getElementById("cpf")).maskPattern(
                    "99.999.999/9999-99"
                );
            } else {
                VMask(document.getElementById("cpf")).unMask();
                VMask(document.getElementById("cpf")).maskPattern(
                    "999.999.999-99"
                );
            }
        },
        initContractWithImmobile() {
            if (this.$route.params.id) {
                this.getImmobile();
            } else {
                this.uiConfig.loading = false;
            }
        },
        saveContract(e) {
            e.preventDefault();
            this.uiConfig.errors = [];
            const Form = new FormData();
            if (this.uiConfig.legalPerson) {
                if (cnpj.isValid(cnpj.format(this.contract.document))) {
                    this.contract.document = cnpj.format(
                        this.contract.document
                    );
                    this.contract.personType = 1;
                } else {
                    return this.uiConfig.errors.push("CNPJ Inválido!");
                }
            } else {
                if (cpf.isValid(cpf.format(this.contract.document))) {
                    this.contract.document = cpf.format(this.contract.document);
                    this.contract.personType = 2;
                } else {
                    return this.uiConfig.errors.push("CPF Inválido!");
                }
            }

            if (!EmailValidator.validate(this.contract.email)) {
                return this.uiConfig.errors.push("E-mail inválido!");
            }

            Form.append("name", this.contract.name);
            Form.append("email", this.contract.email);
            Form.append("personType", parseInt(this.contract.personType));
            Form.append("idImmobile", parseInt(this.contract.idImmobile));
            Form.append("document", this.contract.document);
            Axios.post("/api/contract", Form).then(
                ({ data }) => {
                    this.$router.push("/imoveis");
                },
                error => {
                    const { data } = error.response;
                    this.uiConfig.loading = false;
                    switch (data.status) {
                        case "409":
                            this.uiConfig.errors.push(
                                "Este produto já está sob um contrato!"
                            );
                            break;
                    }
                }
            );
        }
    },
    components: {
        LoadingComponent
    },
    mounted() {
        this.initContractWithImmobile();
    }
};
</script>
