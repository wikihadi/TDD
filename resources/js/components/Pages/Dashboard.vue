<template>
    <v-container
        fluid
    >
        <activity-input></activity-input>
        <v-row
            justify="center"
            align="center"
        >
                   <!--<v-col>-->
                <!--<v-card-->
                    <!--class="mx-auto"-->
                <!--&gt;-->
                    <!--<v-list-item two-line>-->
                        <!--<v-list-item-content class="text-right">-->
                            <!--<v-list-item-title class="headline">دیروز</v-list-item-title>-->
                            <!--<v-list-item-subtitle>{{all.jDYesterday}}</v-list-item-subtitle>-->
                        <!--</v-list-item-content>-->
                    <!--</v-list-item>-->

                    <!--<v-card-text>-->
                        <!--<v-row align="center">-->
                            <!--<v-col class="text-right" cols="12">-->



                            <!--</v-col>-->
                        <!--</v-row>-->
                    <!--</v-card-text>-->




                    <!--<v-divider></v-divider>-->

                    <!--<v-card-actions>-->
                        <!--<v-btn text>آرشیو تسکها</v-btn>-->
                    <!--</v-card-actions>-->
                <!--</v-card>-->
                   <!--</v-col>-->
                   <!--<v-col>-->
                <!--<v-card-->
                    <!--class="mx-auto"-->
                <!--&gt;-->
                    <!--<v-list-item two-line>-->
                        <!--<v-list-item-content class="text-right">-->
                            <!--<v-list-item-title class="headline">{{all.today}}</v-list-item-title>-->
                            <!--<v-list-item-subtitle>{{all.jD}}</v-list-item-subtitle>-->
                        <!--</v-list-item-content>-->
                    <!--</v-list-item>-->

                    <!--<v-card-text>-->
                        <!--<v-row align="center">-->
                            <!--<v-col class="text-right" cols="12">-->



                            <!--</v-col>-->
                        <!--</v-row>-->
                    <!--</v-card-text>-->




                    <!--<v-divider></v-divider>-->

                    <!--<v-card-actions>-->
                        <!--<v-btn text>تسکهای فعال</v-btn>-->
                    <!--</v-card-actions>-->
                <!--</v-card>-->
                   <!--</v-col>-->



        </v-row>
    </v-container>

</template>

<script>
    export default {
        name: "Dashboard",
        data () {
            return {
                all:[],
            }
        },
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    document.title = to.meta.title;
                }
            },
        },
        mounted() {
            this.read();
        },
        methods:{
            read(){
                axios.post('/dashboard/get')
                    .then(
                        response =>
                            this.all = response.data,
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
        }
    }
</script>

<style scoped>

</style>
