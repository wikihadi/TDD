<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-row
                        align="center"
                        justify="center"
                        class=""
                        style="height: 50vh;min-height: 200px"
                >
                    <v-card
                            class="ma-3 pa-6 text-center"
                            tile
                    >
                        <v-icon class="my-5 " style="font-size:200px">mdi-lock</v-icon>
                        <div>
                            شما اجازه دسترسی به این بخش را ندارید
                        </div>
                        <router-link to="/dashboard">

                        <v-btn
                            class="my-5 green"
                            flat
                            block
                    >
                        برو به داشبورد
                    </v-btn>
                        </router-link>
                    </v-card>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: "403"
    }
</script>

<style scoped>

</style>