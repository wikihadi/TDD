<template>
    <v-menu>
        <template v-slot:activator="{ on }">
            <v-btn
                dark
                icon
                v-on="on"
                @click="read"
            >
                <v-badge
                    color="red"
                    :content="notifications.unReadNotifications.length"
                    v-if="notifications.unReadNotifications.length"
                ><v-icon class="animated infinite heartBeat">mdi-bell</v-icon>
                </v-badge>
                <v-icon v-else>mdi-bell-outline</v-icon>

            </v-btn>
        </template>

        <!--<v-list flat dense>-->
            <!--<v-list-item-->
                <!--v-if="notifications.unReadNotifications.length"-->
            <!--&gt;-->
                    <!--<v-list-item-action>-->
                        <!--<v-btn icon>-->
                            <!--<v-icon color="grey lighten-1">mdi-bell-check-outline</v-icon>-->
                        <!--</v-btn>-->
                    <!--</v-list-item-action>-->
            <!--</v-list-item>-->
                <!--</v-list>-->
        <v-list rounded v-if="notifications.unReadNotifications.length>0">
        <v-list-item
                v-for="notification in notifications.unReadNotifications"
                :key="notification.id"
                @click=""
            >
                    <v-list-item-avatar>
                    <v-icon
                        :class="'warning white--text'"
                        v-text="'mdi-bell'"
                    ></v-icon>
                </v-list-item-avatar>
                <v-list-item-content class="text-right">
                    <v-list-item-title>{{notification.data.activity.note}} توسط {{notification.data.activity.user_name}}</v-list-item-title>
                    <v-list-item-subtitle>{{notification.jCreated_atDiff}}</v-list-item-subtitle>
                </v-list-item-content>
                <v-list-item-action>
                    <v-btn icon>
                        <v-icon color="grey lighten-1">mdi-information</v-icon>
                    </v-btn>
                </v-list-item-action>

            </v-list-item>
        </v-list>
        <v-list rounded v-else>
        <v-list-item>
                    <v-list-item-avatar>
                    <v-icon
                        :class="'success white--text'"
                        v-text="'mdi-check'"
                    ></v-icon>
                </v-list-item-avatar>
                <v-list-item-content class="text-right">
                    <v-list-item-title>اعلان جدیدی وجود ندارد</v-list-item-title>
                </v-list-item-content>


            </v-list-item>
        </v-list>

        <!--<v-list rounded dense v-if="notifications.readNotifications.length>0">-->
            <!--<v-list-item-->
                <!--v-for="notification in notifications.readNotifications"-->
                <!--:key="notification.id"-->
                <!--@click=""-->
            <!--&gt;-->
                <!--<v-list-item-avatar>-->
                    <!--<v-icon-->
                        <!--:class="'secondary white&#45;&#45;text'"-->
                        <!--v-text="'mdi-bell'"-->
                    <!--&gt;</v-icon>-->
                <!--</v-list-item-avatar>-->
                <!--<v-list-item-content class="text-right">-->
                    <!--<v-list-item-title v-text="notification.data.activity.note"></v-list-item-title>-->
                    <!--<v-list-item-subtitle>{{notification.jCreated_atDiff}}</v-list-item-subtitle>-->
                <!--</v-list-item-content>-->
                <!--<v-list-item-action>-->
                    <!--<v-btn icon>-->
                        <!--<v-icon color="grey lighten-1">mdi-information</v-icon>-->
                    <!--</v-btn>-->
                <!--</v-list-item-action>-->

            <!--</v-list-item>-->





        <!--</v-list>-->
        <v-bottom-navigation
            color="deep-purple accent-4"
        >
            <v-btn v-if="notifications.unReadNotifications.length" @click="markAllAsRead">
                <v-icon>mdi-bell-check-outline</v-icon>
            </v-btn>

            <v-btn>
                <v-icon>mdi-ballot</v-icon>
            </v-btn>

        </v-bottom-navigation>
    </v-menu>
</template>

<script>
    export default {
        name: "Notification",
        props:['user'],
        data: () => ({
            notifications:[],
            timeToInterval:'',
        }),
        created(){
            this.read();

        },

        mounted() {
            this.intervalSwap()
        },
        methods: {
            intervalSwap(){
                    this.timeToInterval = setInterval(() => {
                        this.read()
                    }, 10000);
            },
            read(){
                axios.get('/notification/read')
                    .then(
                        response =>
                            this.notifications = response.data,
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            markAllAsRead(){
                axios.post('/notification/markAllAsRead')
                    .then(
                        response =>
                            this.notifications = response.data,
                            this.read()
                        )
                        .catch(function (error) {
                            console.log(error)
                        });
            },
        },

    }
</script>

<style scoped>

</style>
