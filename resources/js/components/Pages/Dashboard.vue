<template>
    <v-container
        fluid
    >
        <activity-input></activity-input>
        <v-row
            justify="center"
            align="center"
        >
                   <v-col>
                <v-card
                    class="mx-auto"
                    max-width="400"
                >
                    <v-list-item two-line>
                        <v-list-item-content class="text-right">
                            <v-list-item-title class="headline">شنبه</v-list-item-title>
                            <v-list-item-subtitle>دوازدهم فروردین 1399</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                    <v-card-text>
                        <v-row align="center">
                            <v-col class="display-3 text-center" cols="12">
                                75%
                            </v-col>

                        </v-row>
                    </v-card-text>

                    <!--<v-list-item>-->
                        <!--<v-list-item-icon>-->
                            <!--<v-icon>mdi-cloud-download</v-icon>-->
                        <!--</v-list-item-icon>-->
                        <!--<v-list-item-subtitle>48%</v-list-item-subtitle>-->
                    <!--</v-list-item>-->

                    <!--<v-slider-->
                        <!--v-model="time"-->
                        <!--:max="6"-->
                        <!--:tick-labels="labels"-->
                        <!--class="mx-4"-->
                        <!--ticks-->
                    <!--&gt;</v-slider>-->


                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-btn text>گزارش کامل</v-btn>
                    </v-card-actions>
                </v-card>
                   </v-col>
                   <v-col>
                <v-card
                    class="mx-auto"
                    max-width="400"
                >
                    <v-list-item two-line>
                        <v-list-item-content class="text-right">
                            <v-list-item-title class="headline">شنبه</v-list-item-title>
                            <v-list-item-subtitle>دوازدهم فروردین 1399</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                    <v-card-text>
                        <v-row align="center">
                            <v-col class="display-3 text-center" cols="12">
                                75%
                            </v-col>

                        </v-row>
                    </v-card-text>

                    <!--<v-list-item>-->
                        <!--<v-list-item-icon>-->
                            <!--<v-icon>mdi-cloud-download</v-icon>-->
                        <!--</v-list-item-icon>-->
                        <!--<v-list-item-subtitle>48%</v-list-item-subtitle>-->
                    <!--</v-list-item>-->

                    <!--<v-slider-->
                        <!--v-model="time"-->
                        <!--:max="6"-->
                        <!--:tick-labels="labels"-->
                        <!--class="mx-4"-->
                        <!--ticks-->
                    <!--&gt;</v-slider>-->


                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-btn text>گزارش کامل</v-btn>
                    </v-card-actions>
                </v-card>
                   </v-col>
                   <v-col>
                <v-card
                    class="mx-auto"
                    max-width="400"
                >
                    <v-list-item two-line>
                        <v-list-item-content class="text-right">
                            <v-list-item-title class="headline">شنبه</v-list-item-title>
                            <v-list-item-subtitle>دوازدهم فروردین 1399</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                    <v-card-text>
                        <v-row align="center">
                            <v-col class="display-3 text-center" cols="12">
                                75%
                            </v-col>

                        </v-row>
                    </v-card-text>

                    <!--<v-list-item>-->
                        <!--<v-list-item-icon>-->
                            <!--<v-icon>mdi-cloud-download</v-icon>-->
                        <!--</v-list-item-icon>-->
                        <!--<v-list-item-subtitle>48%</v-list-item-subtitle>-->
                    <!--</v-list-item>-->

                    <!--<v-slider-->
                        <!--v-model="time"-->
                        <!--:max="6"-->
                        <!--:tick-labels="labels"-->
                        <!--class="mx-4"-->
                        <!--ticks-->
                    <!--&gt;</v-slider>-->


                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-btn text>گزارش کامل</v-btn>
                    </v-card-actions>
                </v-card>
                   </v-col>


        </v-row>
    </v-container>

</template>

<script>
    export default {
        name: "Dashboard",
        data () {
            return {
                labels: ['ش', 'ی', 'د', 'س', 'چ', 'پ', 'ج'],
                time: 2,
                forecast: [
                    { day: 'Tuesday', icon: 'mdi-white-balance-sunny', temp: '24\xB0/12\xB0' },
                    { day: 'Wednesday', icon: 'mdi-white-balance-sunny', temp: '22\xB0/14\xB0' },
                    { day: 'Thursday', icon: 'mdi-cloud', temp: '25\xB0/15\xB0' },
                ],
            }
        },
    }
</script>

<style scoped>

</style>
