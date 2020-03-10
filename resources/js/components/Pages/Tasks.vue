<template>
    <div>
        Tasks
    </div>
</template>

<script>
    export default {
        name: "Tasks",
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
