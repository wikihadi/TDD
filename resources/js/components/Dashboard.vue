<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawerRight"
            app
            clipped
            right
        >
            <v-list dense shaped>
                <v-list-item-group color="primary">
                    <router-link to="/dashboard">
                        <v-list-item @click="">
                            <v-list-item-content>
                                <v-list-item-title class="text-right">داشبورد</v-list-item-title>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-action>
                                <v-icon>mdi-home</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </router-link>
                    <router-link to="/dashboard/timer">
                        <v-list-item @click="">
                            <v-list-item-content>
                                <v-list-item-title class="text-right">تایمر</v-list-item-title>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-action>
                                <v-icon>mdi-timer</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </router-link>

                    <v-list-group
                    >
                        <template v-slot:activator>
                            <v-list-item-title class="text-right">کارها</v-list-item-title>
                        </template>
                        <router-link to="/dashboard/tasks">
                            <v-list-item @click="">
                                <v-list-item-content>
                                    <v-list-item-title class="text-right">کارها</v-list-item-title>
                                </v-list-item-content>
                                <v-spacer></v-spacer>
                                <v-list-item-action>
                                    <v-icon>mdi-view-list</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                        </router-link>
                    </v-list-group>

                    <router-link to="/dashboard/fin">
                        <v-list-item @click="">
                            <v-list-item-content>
                                <v-list-item-title class="text-right">مالی</v-list-item-title>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-action>
                                <v-icon>mdi-currency-usd</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </router-link>

                    <v-list-group
                    >
                        <template v-slot:activator>
                            <v-list-item-title class="text-right">ابزار</v-list-item-title>
                        </template>
                        <v-list-item @click.stop="right = !right">
                            <v-list-item-content>
                                <v-list-item-title class="text-right">داخلی ها</v-list-item-title>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-action>
                                <v-icon>mdi-phone</v-icon>
                            </v-list-item-action>
                        </v-list-item>

                    </v-list-group>


                </v-list-item-group>
                <v-list-group
                >
                    <template v-slot:activator>
                        <v-list-item-title class="text-right">مدیریت</v-list-item-title>
                    </template>
                    <router-link to="/dashboard/admin/users">
                        <v-list-item @click="">
                            <v-list-item-content>
                                <v-list-item-title class="text-right">کاربران</v-list-item-title>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-action>
                                <v-icon>mdi-account-group</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </router-link>
                    <router-link to="/dashboard/admin/roles">
                        <v-list-item @click="">
                            <v-list-item-content>
                                <v-list-item-title class="text-right">نقش کاربری</v-list-item-title>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-action>
                                <v-icon>mdi-account-settings</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </router-link>

                </v-list-group>



            </v-list>
            <!--//menu-->
        </v-navigation-drawer>

        <v-app-bar
            app
            clipped-right
            dark
            color="indigo"
        >
            <v-app-bar-nav-icon @click.stop="drawerRight = !drawerRight" />
            <v-toolbar-title>داشبورد</v-toolbar-title>
            <v-spacer />
            <!--<v-text-field-->
            <!--solo-inverted-->
            <!--flat-->
            <!--hide-details-->
            <!--label="جستجو در کارها"-->
            <!--dark-->
            <!--prepend-inner-icon="mdi-search"-->
            <!--v-model="search"-->
            <!--/>-->

            <notification :user="user"></notification>

            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <!--<template v-slot:extension>-->
            <!--<v-tabs-->
            <!--background-color="transparent"-->
            <!--right-->
            <!--icons-and-text-->
            <!--&gt;-->
            <!--<v-tab><v-icon>mdi-label</v-icon></v-tab>-->
            <!--<v-tab><v-icon>mdi-label</v-icon></v-tab>-->
            <!--<v-tab><v-icon>mdi-phone</v-icon></v-tab>-->
            <!--</v-tabs>-->
            <!--</template>-->
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list>
                <v-list-item @click.stop="left = !left">
                    <v-avatar class="ml-3" size="32">
                        <img
                            :src="'/storage/avatar/' + user.avatar"
                            :alt="user.name"
                        >
                    </v-avatar>
                    <!--<v-list-item-content>-->
                    <!--<v-list-item-title>{{user.name}}</v-list-item-title>-->
                    <!--</v-list-item-content>-->
                </v-list-item>
            </v-list>
            <!--Activity Report List-->
            <activity-report-list :qty="10" :user="this.user"></activity-report-list>
        </v-navigation-drawer>

        <v-navigation-drawer
            v-model="left"
            fixed
            temporary
            style="width: 250px"
        >
            <profile :user="user"></profile>
        </v-navigation-drawer>

        <v-content>
            <router-view></router-view>
        </v-content>

        <v-navigation-drawer
            v-model="right"
            fixed
            right
            temporary
            style="width: 500px"
        >
            <contact :user="user"></contact>

        </v-navigation-drawer>

        <v-footer
            app
            color="indigo"
            class="white--text"
        >
            <v-avatar class="ml-3">
                <img
                    :src="'/storage/avatar/' + user.avatar"
                    :alt="user.name"
                >
            </v-avatar>
            <span>{{user.name}}</span>
            <v-spacer />
            <span>{{d}}</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        props:['user','d'],
        data: () => ({
            drawer: null,
            drawerRight: null,
            right: false,
            left: false,
            search:'',
        }),
        mounted: function () {

            // this.changeRTL()

        },
        methods: {
            // changeRTL () {
            //     this.$vuetify.rtl = true
            // },
        },
    }
</script>
