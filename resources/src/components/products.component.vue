<template>
    <section class="products w-full rounded-lg px-4 py-4">
        <header class="py-2 w-full">
            <h4 class="text.title:h4 font-bold color:lead">
                Selecione um produto:
            </h4>
            <hr class="mt-4" />
        </header>
        <section class="w-full flex flex-wrap">
            <div class="lg:w-3/12 w-full px-1 lg:py-0 py-2">
                <select
                    v-model="email"
                    v-on:change="loadStates()"
                    class="input w-full mx-auto px-4 py-2 text:p block rounded-lg bg-white"
                >
                    <option selected disabled value="">
                        E-mail do proprietário
                    </option>
                    <option
                        :key="`email-${index}`"
                        v-for="(email, index) in emailsList"
                        :value="email"
                    >
                        {{ email }}
                    </option>
                </select>
            </div>
            <div class="lg:w-3/12 w-full px-1 lg:py-0 py-2">
                <select
                    :disabled="!statesList.length"
                    v-model="state"
                    v-on:change="loadNeighborhood()"
                    class="input w-full mx-auto px-4 py-2 text:p block rounded-lg bg-white"
                >
                    <option selected disabled value="">
                        Estado
                    </option>
                    <option
                        :key="`state-${index}`"
                        v-for="(state, index) in statesList"
                        :value="state"
                    >
                        {{ state }}
                    </option>
                </select>
            </div>
            <div class="lg:w-3/12 w-full px-1 lg:py-0 py-2">
                <select
                    :disabled="!neighborhoodList.length"
                    v-model="neighborhood"
                    class="input w-full mx-auto px-4 py-2 text:p block rounded-lg bg-white"
                >
                    <option selected disabled value="">
                        Bairro
                    </option>
                    <option
                        :key="`neighborhood-${index}`"
                        v-for="(neighborhood, index) in neighborhoodList"
                        :value="neighborhood"
                    >
                        {{ neighborhood }}
                    </option>
                </select>
            </div>
            <div class="lg:w-3/12 w-full px-1 lg:py-0 py-2">
                <button
                    v-on:click="loadImmobilesToSelectContract()"
                    :disabled="!(email && state && neighborhood)"
                    type="button"
                    class="btn.success text:p color:green w-full py-2 rounded-lg font-light"
                >
                    FILTRAR
                </button>
            </div>
        </section>
        <section v-if="immobiles.length" class="w-full">
            <section
                v-for="(immobile, key) in immobiles"
                :key="`immobile-${key}`"
                class="w-full flex flex-wrap px-1 py-4 items-center"
            >
                <div class="lg:w-8/12 w-full">
                    <p class="text:p color:lead">
                        {{ immobile.address }} - n° {{ immobile.number }},
                        {{ immobile.neighborhood }}, {{ immobile.city }} -
                        {{ immobile.state }}
                    </p>
                </div>
                <div
                    v-if="!immobile.solded"
                    class="lg:w-4/12 w-full lg:text-right"
                >
                    <router-link :to="'/contrato/registro/' + immobile.id">
                        <span
                            class="btn.success text:p color:green px-6 py-2 rounded-lg font-light inline-block"
                        >
                            CONTRATAR
                        </span>
                    </router-link>
                </div>
                <div v-if="immobile.solded" class="w-4/12 text-right">
                    <span
                        class="text:p color:red lg:px-6 py-2 rounded-lg font-bold inline-block"
                    >
                        CONTRATADO
                    </span>
                </div>
                <section class="w-full py-2">
                    <hr />
                </section>
            </section>
        </section>
    </section>
</template>
<script>
import Axios from "axios";

export default {
    name: "Contratos",
    data() {
        return {
            emailsList: [],
            statesList: [],
            neighborhoodList: [],
            email: "",
            state: "",
            neighborhood: "",
            immobiles: []
        };
    },
    methods: {
        loadEmails() {
            Axios.get("/api/immobile/emails").then(({ data }) => {
                this.emailsList = data.response.map(v => {
                    return v.email;
                });
            });
        },
        loadStates() {
            this.statesList = [];
            this.neighborhoodList = [];
            this.immobiles = [];
            this.state = "";
            this.neighborhood = "";
            const Form = new FormData();
            Form.append("email", this.email);
            Axios.post("/api/immobile/states", Form).then(({ data }) => {
                this.statesList = data.response.map(v => {
                    return v.state;
                });
            });
        },
        loadNeighborhood() {
            this.immobiles = [];
            this.neighborhood = "";
            const Form = new FormData();
            Form.append("email", this.email);
            Form.append("state", this.state);
            Axios.post("/api/immobile/neighborhood", Form).then(({ data }) => {
                this.neighborhoodList = data.response.map(v => {
                    return v.neighborhood;
                });
            });
        },
        loadImmobilesToSelectContract() {
            const Form = new FormData();
            Form.append("email", this.email);
            Form.append("state", this.state);
            Form.append("neighborhood", this.neighborhood);
            Axios.post("/api/immobile/filter", Form).then(({ data }) => {
                this.immobiles = data.response;
            });
        }
    },
    mounted() {
        this.loadEmails();
    }
};
</script>
<style>
.products {
    border: solid 0.25px var(--color-gray);
}
</style>
