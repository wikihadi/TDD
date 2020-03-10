<template>
    <v-app>
    <v-container
        fluid
        v-if="all.me.can['role-list']&&all.me.can['permission-list']"
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




                    <v-col v-if="!showPermissions"
                    >
                        <v-card>
                            <v-card-title>


                                <v-dialog v-model="addRole" fullscreen hide-overlay transition="dialog-bottom-transition"
                                v-if="all.me.can['role-add']">
                                    <template v-slot:activator="{ on }">
                                        <v-btn text icon color="green" v-on="on">
                                            <v-icon>mdi-plus-circle</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <form @submit.prevent="submitRole">
                                        <v-toolbar dark color="indigo">
                                            <v-btn icon dark @click="addRole = false">
                                                <v-icon>mdi-close</v-icon>
                                            </v-btn>
                                            <v-toolbar-title>افزودن نقش کاربری</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-toolbar-items>
                                                <v-btn dark text @click="submitRole">ذخیره</v-btn>
                                            </v-toolbar-items>
                                        </v-toolbar>
                                        <v-list three-line subheader class="text-right">
                                            <v-subheader>فرم نقش کاربری</v-subheader>
                                            <v-list-item>
                                                <v-list-item-content>
                                                    <v-text-field
                                                        v-model="titleRole"
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
                                            <v-list-item v-for="item in all.permissions" :key="item.id">
                                                <v-list-item-content class="text-right">
                                                    <v-list-item-title v-text="item.name"></v-list-item-title>
                                                </v-list-item-content>
                                                <v-spacer></v-spacer>
                                                <v-list-item-action>
                                                    <v-checkbox v-model="checkedPermission" :value="item.id"></v-checkbox>
                                                </v-list-item-action>
                                            </v-list-item>
                                        </v-list>
                                        </form>
                                    </v-card>
                                </v-dialog>



                                <v-dialog v-model="updateRole" fullscreen hide-overlay transition="dialog-bottom-transition"
                                          v-if="all.me.can['role-update']">
                                    <v-card>
                                        <form @submit.prevent="uRole(idURole)">
                                        <v-toolbar dark color="amber">
                                            <v-btn icon dark @click="updateRole = false">
                                                <v-icon>mdi-close</v-icon>
                                            </v-btn>
                                            <v-toolbar-title>ویرایش نقش کاربری</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-toolbar-items>
                                                <v-btn dark text @click="uRole(idURole)">ویرایش</v-btn>
                                            </v-toolbar-items>
                                        </v-toolbar>
                                        <v-list three-line subheader class="text-right">
                                            <v-subheader>فرم نقش کاربری</v-subheader>
                                            <v-list-item>
                                                <v-list-item-content>
                                                    <v-text-field
                                                        v-model="titleURole"
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
                                            <v-list-item v-for="item in all.permissions" :key="item.id">
                                                <v-list-item-content class="text-right">
                                                    <v-list-item-title v-text="item.name"></v-list-item-title>
                                                </v-list-item-content>
                                                <v-spacer></v-spacer>
                                                <v-list-item-action>
                                                    <v-checkbox v-model="checkedPermission" :value="item.id"></v-checkbox>
                                                </v-list-item-action>
                                            </v-list-item>
                                        </v-list>
                                        </form>
                                    </v-card>
                                </v-dialog>



                                نقش های کاربری
                            </v-card-title>
                            <v-simple-table>
                                <template v-slot:default>
                                    <thead>
                                    <tr>
                                        <th class="text-right">عنوان</th>
                                        <th class="text-left" v-if="all.me.can['role-del']||all.me.can['role-update']">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in all.roles" :key="item.name">
                                        <td class="text-right">
                                            <v-chip
                                                    class="ma-3"
                                                    v-text="item.name"
                                                >
                                            </v-chip>
                                            <span
                                                    class="ma-2"
                                                    v-for="i in item.permissions"
                                                    :key="i.id"
                                                    v-text="i.name"
                                                    v-if="item.permissions.length>0"
                                            >
                                            </span>
                                            <span
                                                    class="ma-2" v-else
                                            >
                                                No Permission
                                            </span>
                                        </td>
                                        <td class="text-left" v-if="all.me.can['role-del']||all.me.can['role-update']">
                                            <v-btn text icon color="primary" @click="updateRoleOn(item.id,item.name,item.permissions)"
                                                   v-if="all.me.can['role-update']">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>

                                            <v-dialog v-model="dialogRoleDel" persistent max-width="290"
                                                      v-if="all.me.can['role-del']">
                                                <template v-slot:activator="{ on }">
                                                    <v-btn text icon color="secondary" v-on="on">
                                                    <v-icon>mdi-delete</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-card>
                                                    <v-card-title class="headline">حذف نقش</v-card-title>
                                                    <v-card-text>آیا از حذف {{item.name}} اطمینان دارید؟</v-card-text>
                                                    <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn icon color="green darken-1" text @click="dialogRoleDel = false">خیر</v-btn>
                                                    <v-btn icon color="green darken-1" text @click="dialogRoleDel = false,delRole(item.id,item.name)"><v-icon color="red" dark>mdi-delete</v-icon></v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>

                                        </td>
                                    </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>




                    <v-col v-if="showPermissions"
                    >
                        <v-card>
                            <v-card-title>
                                <v-dialog v-model="addPer" fullscreen hide-overlay transition="dialog-bottom-transition"
                                          v-if="all.me.can['permission-add']">
                                    <template v-slot:activator="{ on }">
                                        <v-btn text icon color="green" v-on="on">
                                            <v-icon>mdi-plus-circle</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <form @submit.prevent="submitPer">
                                        <v-toolbar dark color="indigo">
                                            <v-btn icon dark @click="addPer = false">
                                                <v-icon>mdi-close</v-icon>
                                            </v-btn>
                                            <v-toolbar-title>افزودن دسترسی</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-toolbar-items>
                                                <v-btn dark text @click="submitPer">ذخیره</v-btn>
                                            </v-toolbar-items>
                                        </v-toolbar>
                                        <v-list three-line subheader class="text-right">
                                            <!--<v-subheader>فرم دسترسی</v-subheader>-->
                                            <v-list-item>
                                                <v-list-item-content>
                                                        <v-text-field
                                                            v-model="titlePer"
                                                            :rules="rulesPer"
                                                            counter="25"
                                                            label="عنوان دسترسی را وارد کنید"
                                                            hint="فقط نام انگلیسی وارد کنید"
                                                        ></v-text-field>
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list>
                                        </form>
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
                                        <th class="text-left"
                                            v-if="all.me.can['permission-del']||all.me.can['permission-update']"
                                        >عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in all.permissions" :key="item.name">
                                        <td class="text-right">{{ item.name }}</td>
                                        <td class="text-left" v-if="all.me.can['permission-del']||all.me.can['permission-update']">
                                            <!--<v-btn text icon color="primary">-->
                                                <!--<v-icon>mdi-pencil</v-icon>-->
                                            <!--</v-btn>-->

                                            <!--<v-dialog v-model="dialogPermission" persistent max-width="290">-->
                                                <!--<template v-slot:activator="{ on }">-->
                                                    <!--<v-btn text icon color="secondary" v-on="on">-->
                                                        <!--<v-icon>mdi-delete</v-icon>-->
                                                    <!--</v-btn>-->
                                                <!--</template>-->
                                                <!--<v-card>-->
                                                    <!--<v-card-title class="headline">حذف دسترسی</v-card-title>-->
                                                    <!--<v-card-text>آیا از حذف {{item.name}} اطمینان دارید؟</v-card-text>-->
                                                    <!--<v-card-actions>-->
                                                        <!--<v-spacer></v-spacer>-->
                                                        <!--<v-btn icon color="green darken-1" text @click="dialogPermission = false">خیر</v-btn>-->
                                                        <!--<v-btn icon color="green darken-1" text @click="dialogPermission = false,delPer(item.id,item.name)"><v-icon color="red" dark>mdi-delete</v-icon></v-btn>-->
                                                    <!--</v-card-actions>-->
                                                <!--</v-card>-->
                                            <!--</v-dialog>-->



                                            <v-btn text icon color="secondary" @click="dialogPermissionOpen(item.id,item.name)"
                                                   v-if="all.me.can['permission-del']">
                                                <v-icon>mdi-delete</v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>

                                    <v-dialog v-model="dialogPermission" persistent max-width="290" v-if="all.me.can['permission-del']">
                                    <v-card>
                                    <v-card-title class="headline">حذف دسترسی</v-card-title>
                                    <v-card-text>آیا از حذف {{dialogPermissionName}} اطمینان دارید؟</v-card-text>
                                    <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn icon color="green darken-1" text @click="dialogPermission = false">خیر</v-btn>
                                    <v-btn icon color="green darken-1" text @click="dialogPermission = false,delPer(dialogPermissionId,dialogPermissionName)"><v-icon color="red" dark>mdi-delete</v-icon></v-btn>
                                    </v-card-actions>
                                    </v-card>
                                    </v-dialog>

                                    </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-item-group>
    </v-container>
        <e403 v-else></e403>




    </v-app>


</template>

<script>
    export default {
        name: "Role",
        watch: {
            $route: {
                immediate: true,
                handler(to, from) {
                    document.title = to.meta.title;
                }
            },
        },
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            // user_id:document.head.querySelector("meta[name=user_id]").content,
            // user_name:document.head.querySelector("meta[name=user_name]").content,
            showPermissions: false,
            addRole: false,
            addPer: false,
            updateRole: false,
            title: '',
            titlePer: '',
            titleRole: '',
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
            dialogPermission:false,
            dialogPermissionId:'',
            dialogPermissionName:'',
            dialogRoleDel:false,
            checkedPermission: [],
            titleURole:'',
            idURole:'',


        }),
        mounted() {
            this.read(1)

        },
        methods:{
            dialogPermissionOpen(id,name){
                this.dialogPermission=true;
                this.dialogPermissionId=id;
                this.dialogPermissionName=name;

            },
            updateRoleOn(id,name,checked){
                this.updateRole=true;
                this.titleURole=name;
                this.idURole=id;

                let v = [];
                for (let i=0;i<checked.length;i++){
                    v.push(checked[i].id)
                }
                this.checkedPermission=v;

            },
            uRole(id){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let formData = new FormData();
                formData.append('id', id);
                formData.append('permissions', this.checkedPermission);
                formData.append('name', this.titleURole);
                formData.append('_token', this.csrf);
                axios.post('/admin/users/role/update', formData, config)
                    .then(
                        this.read(0),
                        this.updateRole=false,
                        this.titleURole='',
                        this.snackbarOn('نقش با موفقیت ویرایش شد','dark','green',2000)
                    )
                    .catch(function (error) {
                        this.snackbarOn('ظاهرا مشکلی در ویرایش نقش بوجود آمده کد 48022','dark','green',2000),
                        console.log(error)
                    });
            },
            snackbarOn(t,bg,btn,timeout){
                this.snackbarText=t;
                this.snackbarBg=bg;
                this.snackbarBtn=btn;
                this.timeout=timeout;
                this.snackbar=true;
                this.timeout=2000;
            },
            read(x){
                axios.get('/admin/users/rolePer/get')
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
                axios.post('/admin/users/permission/add', formData, config)
                    .then(
                            this.read(0),
                            this.addPer=false,
                            this.titlePer='',
                            this.snackbarOn('دسترسی با موفقیت افزوده شد','dark','green',2000)
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            submitRole(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let formData = new FormData();
                formData.append('permissions', this.checkedPermission);
                formData.append('name', this.titleRole);
                formData.append('_token', this.csrf);
                axios.post('/admin/users/role/add', formData, config)
                    .then(
                            this.read(0),
                            this.addRole=false,
                            this.titleRole='',
                            this.snackbarOn('نقش با موفقیت افزوده شد','dark','green',2000)
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
                axios.post('/admin/users/permission/del', formData, config)
                    .then(
                        this.read(0),
                        this.snackbarOn('دسترسی "' + name + '" با موفقیت حذف شد','red','white',2000)
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
                this.dialogPermissionId='';
                this.dialogPermissionName='';
                },
            delRole(id,name) {
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                let formData = new FormData();
                formData.append('del_id', id);
                formData.append('_token', this.csrf);
                axios.post('/admin/users/role/del', formData, config)
                    .then(
                        this.read(0),
                        this.snackbarOn('نقش "' + name + '" با موفقیت حذف شد','red','white',2000)
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
