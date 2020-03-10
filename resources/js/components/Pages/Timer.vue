<template>
    <v-container
            fluid
    >
        <activity-input></activity-input>

    </v-container>
</template>

<script>
    export default {
        name: "Timer",
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
