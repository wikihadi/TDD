<template>
    <v-container
        fluid
    >
        <v-item-group>
            <v-container>
                <v-subheader>مدیریت کاربران
                <v-chip
                    class="ma-2"
                    color="primary"
                    text-color="white"
                >
                    <v-avatar
                        left
                        class="indigo"
                    >
                        {{users.all.length}}
                    </v-avatar>
                    کاربر
                </v-chip></v-subheader>
                <v-row>
                    <v-col
                        v-for="user in users.all"
                        :key="user.id"
                        cols="12"
                        md="4"
                    >
                        <v-item v-slot:default="">

                            <v-card
                                class="mx-auto"
                                max-width="344"
                                outlined
                            >
                                <v-list-item three-line>
                                    <v-list-item-content>
                                        <div class="overline mb-4 text-right" v-text="user.email"></div>
                                        <v-list-item-title class="headline mb-1 text-right" v-text="user.name"></v-list-item-title>
                                        <v-list-item-subtitle class="text-right" v-text="user.email"></v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-avatar
                                        tile
                                        size="80"
                                    >
                                        <v-avatar>
                                            <img
                                                :src="'/storage/avatar/' + user.avatar"
                                            >
                                        </v-avatar>
                                    </v-list-item-avatar>
                                </v-list-item>

                                <v-card-actions>
                                    <!--<v-btn text>Profile</v-btn>-->
                                    <!--<v-btn text></v-btn>-->
                                    <!--<v-btn text icon>-->
                                    <!--<v-icon color="success">mdi-account-details</v-icon>-->
                                    <!--</v-btn>-->
                                    <v-spacer></v-spacer>
                                    <!--<v-btn text icon small>-->
                                    <!--<v-icon>mdi-account-edit</v-icon>-->
                                    <!--</v-btn>-->

                                    <v-dialog v-model="dialog" persistent max-width="290" v-if="users.all.length>1">
                                        <template v-slot:activator="{ on }">
                                            <v-btn text icon small>
                                                <v-icon color="warning" dark v-on="on">mdi-account-cancel</v-icon>
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title class="headline">حذف کاربر</v-card-title>
                                            <v-card-text>آیا از حذف {{user.name}} اطمینان دارید؟</v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="green darken-1" text @click="dialog = false">خیر</v-btn>
                                                <v-btn color="green darken-1" text @click="dialog = false,del(user.id)"><v-icon color="warning" dark>mdi-account-cancel</v-icon></v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-card-actions>


                            </v-card>

                        </v-item>
                    </v-col>
                </v-row>
            </v-container>
        </v-item-group>
    </v-container>
</template>

<script>
    export default {
        name: "Users",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            show: false,
            dialog: false,
            users:[]
        }),
        mounted() {
            this.read()
        },
        methods:{
            read(){
                axios.get('/api/admin/users/get')
                    .then(
                        response =>
                            this.users = response.data
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            del(id) {
                axios.get('/api/admin/users/del?id=' + id)
                    .then(
                        this.read()
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
