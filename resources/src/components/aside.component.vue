<template>
    <aside class="Menu.aside fixed left-0 top-0 px-2 bg-lead">
        <nav class="w-full">
            <ul class="w-full text-center pt-10">
                <li class="Menu.link py-2">
                    <router-link to="/">
                        <span class="text-white text.title:h3">
                            <i class="fa fa-plus-square"></i>
                        </span>
                    </router-link>
                </li>
                <li class="Menu.link py-2">
                    <router-link to="/imoveis">
                        <span class="text-white text.title:h3">
                            <i class="fa fa-list"></i>
                        </span>
                    </router-link>
                </li>
                <li class="Menu.link py-2">
                    <router-link to="/contrato">
                        <span class="text-white text.title:h3">
                            <i class="fa fa-file"></i>
                        </span>
                    </router-link>
                </li>
            </ul>
        </nav>
    </aside>
</template>
<style>
.Menu\.aside {
    width: 100px;
    min-height: 100vh;
}
</style>
