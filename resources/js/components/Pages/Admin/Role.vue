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
                        @click="showPermissions=false"
                    >
                        <v-avatar
                            left
                            class="indigo"
                        >
                            {{roles.length}}
                        </v-avatar>
                        نقش
                    </v-chip>
                    <v-chip
                        class="ma-2"
                        color="primary"
                        text-color="white"
                        @click="showPermissions=true"
                    >
                        <v-avatar
                            left
                            class="indigo"
                        >
                            {{per.length}}
                        </v-avatar>
                        دسترسی
                    </v-chip>
                </v-subheader>
                <v-row>
                    <v-col v-if="!showPermissions">
                        <v-card>
                            <v-card-title>
                                <v-dialog v-model="addRole" fullscreen hide-overlay transition="dialog-bottom-transition">
                                    <template v-slot:activator="{ on }">
                                        <v-btn text icon color="green" v-on="on">
                                            <v-icon>mdi-plus-circle</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-toolbar dark color="indigo">
                                            <v-btn icon dark @click="addRole = false">
                                                <v-icon>mdi-close</v-icon>
                                            </v-btn>
                                            <v-toolbar-title>افزودن نقش کاربری</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-toolbar-items>
                                                <v-btn dark text @click="addRole = false">ذخیره</v-btn>
                                            </v-toolbar-items>
                                        </v-toolbar>
                                        <v-list three-line subheader class="text-right">
                                            <v-subheader>فرم نقش کاربری</v-subheader>
                                            <v-list-item>
                                                <v-list-item-content>
                                                    <v-text-field
                                                        v-model="title"
                                                        :rules="rules"
                                                        counter="15"
                                                        label="عنوان نقش را وارد کنید"
                                                        hint="فقط نام انگلیسی وارد کنید"
                                                        outlined
                                                    ></v-text-field>
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list>
                                        <v-divider></v-divider>
                                        <v-list subheader>
                                            <v-subheader>دسترسی ها</v-subheader>
                                            <v-list-item @click="notifications=!notifications">
                                                <v-list-item-content class="text-right">
                                                    <v-list-item-title>ایجاد پروژه</v-list-item-title>
                                                </v-list-item-content>
                                                <v-spacer></v-spacer>
                                                <v-list-item-action>
                                                    <v-checkbox v-model="notifications"></v-checkbox>
                                                </v-list-item-action>
                                            </v-list-item>
                                            <v-list-item @click="notifications=!notifications">
                                                <v-list-item-content class="text-right">
                                                    <v-list-item-title>ایجاد پروژه</v-list-item-title>
                                                </v-list-item-content>
                                                <v-spacer></v-spacer>
                                                <v-list-item-action>
                                                    <v-checkbox v-model="notifications"></v-checkbox>
                                                </v-list-item-action>
                                            </v-list-item>
                                            <v-list-item @click="notifications=!notifications">
                                                <v-list-item-content class="text-right">
                                                    <v-list-item-title>ایجاد پروژه</v-list-item-title>
                                                </v-list-item-content>
                                                <v-spacer></v-spacer>
                                                <v-list-item-action>
                                                    <v-checkbox v-model="notifications"></v-checkbox>
                                                </v-list-item-action>
                                            </v-list-item>
                                            <v-list-item @click="notifications=!notifications">
                                                <v-list-item-content class="text-right">
                                                    <v-list-item-title>ایجاد پروژه</v-list-item-title>
                                                </v-list-item-content>
                                                <v-spacer></v-spacer>
                                                <v-list-item-action>
                                                    <v-checkbox v-model="notifications"></v-checkbox>
                                                </v-list-item-action>
                                            </v-list-item>
                                        </v-list>
                                    </v-card>
                                </v-dialog>
                                نقش های کاربری
                                <!--<v-spacer></v-spacer>-->
                                <!--<v-text-field-->
                                    <!--v-model="search"-->
                                    <!--append-icon="mdi-magnify"-->
                                    <!--label="جستجو"-->
                                    <!--single-line-->
                                    <!--hide-details-->
                                <!--&gt;</v-text-field>-->
                            </v-card-title>
                            <v-simple-table>
                                <template v-slot:default>
                                    <thead>
                                    <tr>
                                        <th class="text-right">عنوان</th>
                                        <th class="text-left">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in roles" :key="item.name">
                                        <td class="text-right">{{ item.name }}</td>
                                        <td class="text-left">
                                            <v-btn text icon color="primary">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                            <v-btn text icon color="secondary">
                                                <v-icon>mdi-delete</v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>
                    <v-col v-if="showPermissions">
                        <v-card>
                            <v-card-title>
                                <v-dialog v-model="addPer" fullscreen hide-overlay transition="dialog-bottom-transition">
                                    <template v-slot:activator="{ on }">
                                        <v-btn text icon color="green" v-on="on">
                                            <v-icon>mdi-plus-circle</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-toolbar dark color="indigo">
                                            <v-btn icon dark @click="addPer = false">
                                                <v-icon>mdi-close</v-icon>
                                            </v-btn>
                                            <v-toolbar-title>افزودن دسترسی</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-toolbar-items>
                                                <v-btn dark text @click="addPer = false">ذخیره</v-btn>
                                            </v-toolbar-items>
                                        </v-toolbar>
                                        <v-list three-line subheader class="text-right">
                                            <v-subheader>فرم دسترسی</v-subheader>
                                            <v-list-item>
                                                <v-list-item-content>
                                                    <v-text-field
                                                        v-model="titlePer"
                                                        :rules="rulesPer"
                                                        counter="25"
                                                        label="عنوان دسترسی را وارد کنید"
                                                        hint="فقط نام انگلیسی وارد کنید"
                                                        outlined
                                                    ></v-text-field>
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list>
                                    </v-card>
                                </v-dialog>
                                دسترسی های کاربری
                                <!--<v-spacer></v-spacer>-->
                                <!--<v-text-field-->
                                    <!--v-model="search"-->
                                    <!--append-icon="mdi-magnify"-->
                                    <!--label="جستجو"-->
                                    <!--single-line-->
                                    <!--hide-details-->
                                <!--&gt;</v-text-field>-->
                            </v-card-title>
                            <v-simple-table>
                                <template v-slot:default>
                                    <thead>
                                    <tr>
                                        <th class="text-right">عنوان</th>
                                        <th class="text-left">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in per" :key="item.name">
                                        <td class="text-right">{{ item.name }}</td>
                                        <td class="text-left">
                                            <v-btn text icon color="primary">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                            <v-btn text icon color="secondary">
                                                <v-icon>mdi-delete</v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-item-group>
    </v-container>
</template>

<script>
    export default {
        name: "Role",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            user_id:document.head.querySelector("meta[name=user_id]").content,
            user_name:document.head.querySelector("meta[name=user_name]").content,
            showPermissions: false,
            addRole: false,
            addPer: false,
            title: '',
            titlePer: '',
            notifications: false,
            rules: [v => v.length <= 15 || 'سقف تعداد کاراکتر پر شد'],
            rulesPer: [v => v.length <= 25 || 'سقف تعداد کاراکتر پر شد'],
            search: '',
            roles: [
                {
                    name: 'super-admin'
                },
                {
                    name: 'admin'
                },
                ],
            per: [
                {
                    name: 'can-task-edt'
                },
                {
                    name: 'can-delete-task'
                },
                ]

        }),
        mounted() {

        },
        methods:{
            read(){
                axios.get('/api/admin/users/roles/get')
                    .then(
                        response =>
                            this.roles = response.data
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },

            // del() {
            //     const config = {
            //         headers: { 'content-type': 'multipart/form-data' }
            //     };
            //
            //
            //     let formData = new FormData();
            //
            //     formData.append('del_id', this.delete_id);
            //     formData.append('_token', this.csrf);
            //     formData.append('user_id', this.user_id);
            //     formData.append('user_name', this.user_name);
            //
            //
            //     axios.post('/api/admin/users/del', formData, config)
            //         .then(
            //             response =>
            //                 this.users = response.data
            //         )
            //         .catch(function (error) {
            //             console.log(error)
            //         });
            // },
        }
    }
</script>

<style scoped>
</style>
