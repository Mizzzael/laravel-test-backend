<template>
    <div>
        <button
            v-on:click="toggle"
            class="aside.close text.title:h4 mx-1 my-1 px-2 py-2"
        >
            <i class="fa fa-bars"></i>
        </button>
        <aside
            :class="
                'Menu.aside fixed left-0 top-0 px-2 bg-lead' +
                    (active ? ' active' : '')
            "
        >
            <nav class="w-full">
                <ul class="w-full text-center pt-10">
                    <li
                        v-on:click="toggle"
                        class="Menu.link py-2 lg:hidden block"
                    >
                        <span class="text-white text.title:h3">
                            <i class="fa fa-times"></i>
                        </span>
                    </li>
                    <li class="Menu.link py-2">
                        <router-link to="/">
                            <span
                                v-on:click="closeAside"
                                class="text-white text.title:h3"
                            >
                                <i class="fa fa-plus-square"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="Menu.link py-2">
                        <router-link to="/imoveis">
                            <span
                                v-on:click="closeAside"
                                class="text-white text.title:h3"
                            >
                                <i class="fa fa-list"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="Menu.link py-2">
                        <router-link to="/contrato">
                            <span
                                v-on:click="closeAside"
                                class="text-white text.title:h3"
                            >
                                <i class="fa fa-file"></i>
                            </span>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </aside>
    </div>
</template>
<script>
export default {
    name: "Menu",
    data() {
        return {
            active: false
        };
    },
    methods: {
        toggle() {
            this.active = !this.active;
        },
        closeAside() {
            if (this.active) this.active = false;
        }
    }
};
</script>
<style>
.Menu\.aside {
    width: 100px;
    min-height: 100vh;
}

@media only screen and (max-width: 768px) {
    .Menu\.aside {
        z-index: 99999;
        transition: ease 220ms all;
        left: -100px;
    }

    .Menu\.aside.active {
        left: 0;
    }
}
</style>
