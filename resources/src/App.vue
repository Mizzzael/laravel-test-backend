<template>
    <main
        id="root"
        class="App w-full bg-white fixed left-0 right-0 top-0 bottom-0 m-auto"
    >
        <AsideComponent />
        <section class="container mx-auto">
            <router-view />
        </section>
    </main>
</template>
<script>
import AsideComponent from "./components/aside.component";
export default {
    name: "Root",
    components: {
        AsideComponent
    }
};
</script>
<style>
.App {
    min-height: 100vh;
    overflow: auto;
}
</style>
