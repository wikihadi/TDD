<template>
    <div>
        Fin
    </div>
</template>

<script>
    export default {
        name: "Fin",
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    document.title = to.meta.title;
                }
            },
        },
    }
</script>

<style scoped>

</style>
