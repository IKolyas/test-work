<template>
    <div>
        <Header></Header>
        <main class="container content">
            <router-view></router-view>
        </main>
        <Footer></Footer>
    </div>

</template>

<script>
import Footer from "./Footer";
import Header from "./Header";
export default {
    name: "App",
    components: {Header, Footer}
}
</script>

<style scoped>

</style>
