<template>
    <header>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand href="/">Объявления</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item href="/">Список объявлений</b-nav-item>
                    <b-nav-item href="/create">Добавить</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>

</style>
