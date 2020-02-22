<template>
    <v-container
        fluid
    >
        <v-snackbar
            v-model="snackbar"
            :timeout="timeout"
            :color="snackbarBg"
            :left="true"
        >
            {{ snackbarText }}
            <v-btn
                :color="snackbarBtn"
                text
                @click="snackbar = false"
            >
                بستن
            </v-btn>
        </v-snackbar>




        <v-item-group>
            <v-container>
                <v-subheader>
                    مدیریت کاربران
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
                            {{all.roles.length}}
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
                            {{all.permissions.length}}
                        </v-avatar>
                        دسترسی
                    </v-chip>
                <v-spacer></v-spacer>
                    <v-btn icon text>
                        <v-icon color="eee" @click="read(1)">mdi-refresh</v-icon>
                    </v-btn>
                    <router-link to="/dashboard/admin/help">
                        <v-btn icon text>
                            <v-icon color="eee" @click="">mdi-lifebuoy</v-icon>
                        </v-btn>
                    </router-link>

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
                                    <tr v-for="item in all.roles" :key="item.name">
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
                                            <!--<v-subheader>فرم دسترسی</v-subheader>-->
                                            <v-list-item>
                                                <v-list-item-content>
                                                    <form @submit.prevent="submitPer">
                                                        <v-text-field
                                                            v-model="titlePer"
                                                            :rules="rulesPer"
                                                            counter="25"
                                                            label="عنوان دسترسی را وارد کنید"
                                                            hint="فقط نام انگلیسی وارد کنید"
                                                        ></v-text-field>
                                                    </form>
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
                                    <tr v-for="item in all.permissions" :key="item.name">
                                        <td class="text-right">{{ item.name }}</td>
                                        <td class="text-left">
                                            <!--<v-btn text icon color="primary">-->
                                                <!--<v-icon>mdi-pencil</v-icon>-->
                                            <!--</v-btn>-->

                                            <v-dialog v-model="dialogPermission" persistent max-width="290">
                                                <template v-slot:activator="{ on }">
                                                    <v-btn text icon color="secondary" v-on="on">
                                                        <v-icon>mdi-delete</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title class="headline">حذف دسترسی</v-card-title>
                                                    <v-card-text>آیا از حذف {{item.name}} اطمینان دارید؟</v-card-text>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn icon color="green darken-1" text @click="dialogPermission = false">خیر</v-btn>
                                                        <v-btn icon color="green darken-1" text @click="dialogPermission = false,delPer(item.id,item.name)"><v-icon color="red" dark>mdi-delete</v-icon></v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>



                                            <!--<v-btn text icon color="secondary" @click="delPer(item.id,item.name)">-->
                                                <!--<v-icon>mdi-delete</v-icon>-->
                                            <!--</v-btn>-->
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
            all:[],
            snackbarText:'',
            snackbar: false,
            timeout: 2000,
            snackbarBg:'',
            snackbarBtn:'blue',
            dialogPermission:false

        }),
        mounted() {
            this.read(1)

        },
        methods:{
            snackbarOn(t,bg,btn,timeout){
                this.snackbarText=t;
                this.snackbarBg=bg;
                this.snackbarBtn=btn;
                this.timeout=timeout;
                this.snackbar=true;
                this.timeout=2000;
            },
            read(x){
                axios.get('/api/admin/users/rolePer/get')
                    .then(
                        response =>
                            this.all = response.data,

                    )
                    .catch(function (error) {
                        console.log(error)
                    });
                if(x===1){
                    this.snackbarOn('اطلاعات نقش کاربری و دسترسی ها با موفقیت دریافت شد','cyan darken-2','light')
                }
            },
            submitPer(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let formData = new FormData();
                formData.append('name', this.titlePer);
                formData.append('_token', this.csrf);
                formData.append('user_id', this.user_id);
                formData.append('user_name', this.user_name);
                axios.post('/api/admin/users/rolePer/addPer', formData, config)
                    .then(
                            this.read(0),
                            this.addPer=false,
                            this.snackbarOn('دسترسی با موفقیت افزوده شد','dark','green',2000)
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            delPer(id,name) {
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                let formData = new FormData();
                formData.append('del_id', id);
                formData.append('_token', this.csrf);
                formData.append('user_id', this.user_id);
                formData.append('user_name', this.user_name);
                axios.post('/api/admin/users/rolePer/delPer', formData, config)
                    .then(
                        this.read(0),
                        this.snackbarOn('دسترسی "' + name + '" با موفقیت حذف شد','red','white',2000)
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
