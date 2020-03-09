<template>
    <div>
    <v-container
        fluid
        v-if="users.me.can['user-list']"
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
                <v-subheader>مدیریت کاربران
                <v-chip
                    class="ma-2"
                    color="primary"
                    text-color="white"
                    @click="read"
                >
                    <v-avatar
                        left
                        class="indigo"
                    >
                        {{users.all.length}}
                    </v-avatar>
                    کاربر
                    <!--<v-avatar-->
                        <!--right-->
                    <!--&gt;-->
                        <!--<v-icon>mdi-refresh</v-icon>-->
                    <!--</v-avatar>-->
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
                                        <div class="overline mb-4 text-right">{{user.jCreated_atDiff}} - {{user.jCreated_at}}</div>
                                        <v-list-item-title class="headline mb-2 text-right" v-text="user.name"></v-list-item-title>

                                        <v-tooltip right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                            @click="userEditDialog=user,editUser=true"
                                                    >
                                                        <v-icon dark>mdi-account-circle</v-icon>
                                                    </v-btn>
                                                    <v-chip
                                                            v-if="user.roles.length>0"
                                                            class="ma-2"
                                                            small
                                                            v-for="r in user.roles"
                                                            :key="r.id"
                                                            color="amber"
                                                    >
                                                        {{r.name}}
                                                    </v-chip>
                                                    <v-chip
                                                            v-if="user.roles.length<1"
                                                            class="ma-2"
                                                            small
                                                            color="red"
                                                    >
                                                        بدون نقش
                                                    </v-chip>
                                                </v-list-item-subtitle>
                                            </template>
                                            <span>نقش کاربری</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.etiquette" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                    >
                                                        <v-icon dark>mdi-account-circle-outline</v-icon>
                                                    </v-btn>
                                                    {{user.etiquette}}
                                                </v-list-item-subtitle>
                                            </template>
                                            <span>سمت</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.email" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <v-btn :href="'mailto:'+user.email"
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                    >
                                                        <v-icon dark>mdi-email-send</v-icon>
                                                    </v-btn>
                                                    {{user.email}}
                                                </v-list-item-subtitle>
                                            </template>
                                            <span>پست الکترونیکی</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.mobile" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <a :href="'tel:'+user.mobile"><v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                    >
                                                        <v-icon dark>mdi-cellphone</v-icon>
                                                    </v-btn></a>
                                                {{user.mobile}}
                                                </v-list-item-subtitle>

                                            </template>
                                            <span>همراه</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.insurance" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle v-on="on" class="text-right mb-1">
                                                    <v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                            v-clipboard:copy="user.card"
                                                            v-clipboard:success="onCopySuccess"
                                                            v-clipboard:error="onCopyError"
                                                    >
                                                        <v-icon dark>mdi-content-copy</v-icon>
                                                    </v-btn>
                                                    {{user.insurance}}

                                                </v-list-item-subtitle>
                                            </template>
                                            <span>کد بیمه</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.card" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                            v-clipboard:copy="user.card"
                                                            v-clipboard:success="onCopySuccess"
                                                            v-clipboard:error="onCopyError"
                                                    >
                                                        <v-icon dark>mdi-content-copy</v-icon>
                                                    </v-btn>
                                                    {{user.card.slice(0, 4)}}-{{user.card.slice(4, 8)}}-{{user.card.slice(8, 12)}}-{{user.card.slice(12, 16)}}

                                                </v-list-item-subtitle>
                                            </template>
                                            <span>کارت بانکی</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.bank" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                    >
                                                        <v-icon>mdi-bank</v-icon>
                                                    </v-btn>
                                                    {{user.bank}}
                                                </v-list-item-subtitle>
                                            </template>
                                            <span>بانک</span>
                                        </v-tooltip>
                                        <v-tooltip v-if="user.account_code" right>
                                            <template v-slot:activator="{ on }">
                                                <v-list-item-subtitle @click="" v-on="on" class="text-right mb-1">
                                                    <v-btn
                                                            class="mx-2"
                                                            flat
                                                            icon
                                                            fab
                                                            x-small
                                                            v-clipboard:copy="user.account_code"
                                                            v-clipboard:success="onCopySuccess"
                                                            v-clipboard:error="onCopyError"
                                                    >
                                                        <v-icon dark>mdi-content-copy</v-icon>
                                                    </v-btn>
                                                    {{user.account_code}}

                                                </v-list-item-subtitle>
                                            </template>
                                            <span>حساب بانکی</span>
                                        </v-tooltip>

                                    </v-list-item-content>

                                    <v-list-item-avatar
                                        tile
                                        size="50"
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
                                    <v-btn text icon small fab @click="userEditDialog=user,editUser=true" v-if="users.me.can['user-update']">
                                    <v-icon>mdi-account-edit</v-icon>
                                    </v-btn>
                                    <v-btn text icon small @click="dialog=true,delete_id=user.id,delete_name=user.name" v-if="user.id!=users.me.id&&users.me.can['user-del']">
                                        <v-icon color="red">mdi-account-cancel</v-icon>
                                    </v-btn>
                                </v-card-actions>


                            </v-card>

                        </v-item>
                    </v-col>

                    <!--Delete User Dialog-->
                    <v-dialog v-model="dialog" max-width="290">
                        <v-card>
                            <v-card-title class="headline">حذف کاربر</v-card-title>
                            <v-card-text>آیا از حذف {{delete_name}} اطمینان دارید؟</v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn icon color="green darken-1" text @click="dialog = false">خیر</v-btn>
                                <v-btn icon text @click="dialog = false,del(),delete_id='',delete_name=''"><v-icon color="red" dark>mdi-account-cancel</v-icon></v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <!--End delete user dialog-->


                    <!--Edit User Dialog-->
                    <v-dialog v-model="editUser" fullscreen hide-overlay transition="dialog-bottom-transition">
                          <v-card>
                            <form @submit.prevent="submitPer">
                                <v-toolbar dark color="amber">
                                    <v-btn icon dark @click="editUser = false">
                                        <v-icon>mdi-close</v-icon>
                                    </v-btn>
                                    <v-toolbar-title>ویرایش کاربر
                                         {{userEditDialog.name}}
                                    </v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-toolbar-items>
                                        <v-btn dark text @click="updateUser">ویرایش</v-btn>
                                    </v-toolbar-items>
                                </v-toolbar>
                                <v-list three-line subheader class="text-right">
                                    <!--<v-subheader>فرم دسترسی</v-subheader>-->
                                    <v-list-item>
                                        <v-list-item-content>
                                            <v-container
                                                    fluid
                                            >
                                                <v-row
                                                        :align="center"
                                                        :justify="center"
                                                >
                                                    <v-col md="3">
                                                        <v-tooltip top>
                                                        <template v-slot:activator="{ on }">
                                                            <v-img @click="changeAvatar=!changeAvatar" v-on="on" :src="'/storage/avatar/' + userEditDialog.avatar" alt="تصویر پروفایل" aspect-ratio="1" v-if="userEditDialog.avatar"></v-img>

                                                        </template>
                                                        <span>تعویض عکس پروفایل</span>
                                                        </v-tooltip>
                                                        <v-file-input v-model="avatar" accept="image/*" show-size label="تصویر پروفایل" prepend-icon="mdi-camera" v-if="changeAvatar"></v-file-input>

                                                    </v-col>
                                                </v-row>
                                                <v-row
                                                        :align="center"
                                                        :justify="center"
                                                >
                                                    <v-col md="6">
                                                        <v-text-field
                                                                v-model="userEditDialog.email"
                                                                label="پست الکترونیک"
                                                                disabled
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col md="6">
                                                        <v-text-field
                                                                v-model="userEditDialog.etiquette"
                                                                :rules="rulesPer"
                                                                counter="25"
                                                                label="سمت سازمانی"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col md="4">
                                                        <v-text-field
                                                                v-model="userEditDialog.name"
                                                                :rules="rulesPer"
                                                                counter="25"
                                                                label="نام کاربر"
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col md="4">
                                                        <v-text-field
                                                                v-model="userEditDialog.mobile"
                                                                :rules="rulesPer"
                                                                counter="11"
                                                                label="شماره همراه"
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col md="4">
                                                        <v-text-field
                                                                v-model="userEditDialog.insurance"
                                                                :rules="rulesPer"
                                                                counter="8"
                                                                label="کد بیمه"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col md="4">
                                                        <v-text-field
                                                                v-model="userEditDialog.card"
                                                                :rules="rulesPer"
                                                                counter="16"
                                                                label="کارت بانکی"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col md="4">
                                                        <v-text-field
                                                                v-model="userEditDialog.bank"
                                                                :rules="rulesPer"
                                                                counter="16"
                                                                label="بانک"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col md="4">
                                                        <v-text-field
                                                                v-model="userEditDialog.account_code"
                                                                :rules="rulesPer"
                                                                counter="25"
                                                                label="شماره حساب بانکی"
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col md="12">
                                                        <v-text-field
                                                                v-model="userEditDialog.comment"
                                                                :rules="rulesPer"
                                                                counter="250"
                                                                label="توضیحات کاربر"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col md="12">
                                                        <v-select
                                                                :hint="'این قسمت توسط مدیر تکمیل می گردد'"
                                                                v-model="userEditDialog.roles"
                                                                :items="users.rolesAll"
                                                                item-text="name"
                                                                item-value="id"
                                                                attach
                                                                chips
                                                                label="نقش ها"
                                                                multiple
                                                        ></v-select>
                                                    </v-col>
                                                    <v-col sm="12">
                                                        <v-btn color="success" dark flat @click="editUser = false">انصراف</v-btn>
                                                        <v-btn color="secondary" dark flat  @click="updateUser">ویرایش</v-btn>

                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </form>
                        </v-card>
                    </v-dialog>
                    <!--End Edit User Dialog-->
                </v-row>
            </v-container>
        </v-item-group>
    </v-container>
<e403 v-else></e403>
    </div>
</template>

<script>
    export default {
        name: "Users",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            show: false,
            dialog: false,
            users:[],
            delete_id:'',
            delete_name:'',
            snackbarText:'',
            snackbar: false,
            timeout: 2000,
            snackbarBg:'',
            snackbarBtn:'blue',
            changeAvatar:false,
            editUser:false,
            userEditDialog:[],
            avatar:'',
        }),
        mounted() {
            this.read();
        },
        methods:{
            updateUser(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                let json_userEditDialog = JSON.stringify(this.userEditDialog);

                let formData = new FormData();
                formData.append('user', json_userEditDialog);
                formData.append('avatar', this.avatar);
                formData.append('_token', this.csrf);
                axios.post('/admin/users/update', formData, config)
                    .then(
                        this.read(0),
                        this.editUser=false,
                        this.userEditDialog=[],
                        this.snackbarOn('کاربر با موفقیت ویرایش شد','dark','green',2000)
                    )
                    .catch(function (error) {
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
            onCopySuccess(){
                this.snackbarOn('در حافظه کپی شد','green darken-2','light')
            },
            onCopyError(){
                this.snackbarOn('اوپس... کپی نشد','red darken-2','light')
            },
            read(){
                axios.get('/admin/users/get')
                    .then(
                        response =>
                            this.users = response.data,
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            // del(id) {
            //     axios.get('/api/admin/users/del?id=' + id + '&user_id=' + this.user_id + '$user_name=' + this.user_name)
            //         .then(
            //             this.read()
            //         )
            //         .catch(function (error) {
            //             console.log(error)
            //         });
            // },

            del() {
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };


                let formData = new FormData();

                formData.append('del_id', this.delete_id);
                formData.append('_token', this.csrf);


                axios.post('/admin/users/del', formData, config)
                    .then(
                        response =>
                            this.users = response.data
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            //
            // del(id) {
            //     axios.post('/api/admin/users/del')
            //         .then(
            //             response => this.users = response.data
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
