<template>
    <div>
        Contact List
    </div>
</template>

<script>
    export default {
        name: "ContactList",
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
