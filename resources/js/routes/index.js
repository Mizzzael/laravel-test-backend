// Pages
import RegisterComponent from "../../src/pages/register.component.vue";
import ListComponent from "../../src/pages/list.component.vue";
import ContractComponent from "../../src/pages/contract.component.vue";

export default [
    {
        path: "/",
        component: RegisterComponent
    },
    {
        name: "List",
        path: "/imoveis",
        component: ListComponent
    },
    {
        path: "/contrato",
        component: ContractComponent
    },
    {
        path: "/contrato/:id",
        component: ContractComponent
    }
];
