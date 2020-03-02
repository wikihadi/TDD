<template>
    <v-app>
        <v-card>
            <v-card>
                <v-toolbar flat>
                    <v-text-field
                    class="m-3 mt-5"
                    v-model="name"
                    placeholder="جستجوی نام"
                    clearable
                    hint="برای مثال: محمد حریری"
                    dense
                    ></v-text-field>
                </v-toolbar>
                <v-container
                    style="height: 50vh"
                    class="overflow-y-auto"
                    dark
                >
                    <v-list flat>
                    <v-list-item-group v-model="item" color="primary">

                        <v-dialog
                            v-model="dialog"
                            width="500"
                            v-for="(item, i) in filteredList"
                            :key="i"
                        >
                            <template v-slot:activator="{ on }">
                                <v-list-item
                                    v-on="on"
                                    clickable>
                                <v-text>
                                    {{item.name}}
                                </v-text>
                                <v-spacer></v-spacer>
                                <v-chip>
                                    {{item.intercom}}
                                </v-chip>
                                </v-list-item>
                            </template>
<!--// دیالوگ کانتکت هر آیتم-->
                            <v-card>
                                <!--<v-card-title-->
                                    <!--class="headline grey lighten-2"-->
                                    <!--primary-title-->
                                <!--&gt;-->
                                    <!--{{item.name}}-->
                                <!--</v-card-title>-->

                                <v-card-text>
                                    <v-list rounded>
                                        <v-subheader>{{item.name}}</v-subheader>
                                        <v-list-item-group color="primary">

                                            <v-list-item v-if="item.note!==null" :title="item.note">
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.note"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>

                                            <v-list-item v-if="item.organization!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-account-tie</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.organization"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>

                                            <v-list-item v-if="item.intercom!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-phone-voip</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.intercom"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>

                                            <v-list-item v-if="item.mobile!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-cellphone</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.mobile"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>

                                            <v-list-item v-if="item.tel!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-phone</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.tel"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>

                                            <a :href="'mailto:' + item.email">
                                                <v-list-item v-if="item.email!==null">
                                                    <v-list-item-icon>
                                                        <v-icon>mdi-email</v-icon>
                                                    </v-list-item-icon>
                                                    <v-list-item-content>
                                                        <v-list-item-title v-text="item.email"></v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </a>

                                            <v-list-item v-if="item.dob!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-calendar-heart</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.dob"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <a :href="item.web" target="_blank">

                                            <v-list-item v-if="item.web!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-web</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.web"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>

                                            </a>

                                            <v-list-item v-if="item.address!==null">
                                                <v-list-item-icon>
                                                    <v-icon>mdi-map-marker</v-icon>
                                                </v-list-item-icon>
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="item.address"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list-item-group>
                                    </v-list>
                                </v-card-text>
                            </v-card>
                        </v-dialog>

                    </v-list-item-group>
                    </v-list>
                    <router-link to="/dashboard/contact-list">
                    <v-btn text small color="primary">مشاهده لیست تماس</v-btn></router-link>
                    <!--// دیالوگ افزودن آیتم-->
                    <v-dialog v-model="addDialog" persistent max-width="600px">
                        <template v-slot:activator="{ on }">
                            <v-btn
                                absolute
                                dark
                                fab
                                bottom
                                right
                                color="indigo"
                                v-on="on"
                                >
                                <v-icon>mdi-plus</v-icon>
                            </v-btn>
                        </template>

                        <!--//Form Start-->
                        <form @submit.prevent="addContact">

                        <v-card>
                            <v-card-title>
                                <h4>اطلاعات تماس</h4>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6">
                                            <v-text-field
                                                v-model="name"
                                                :rules="nameRules"
                                                label="نام*"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-text-field
                                                v-model="organization"
                                                label="سمت / سازمان" hint="برای مثال: واحد فروش"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="mobile"
                                                :rules="telRules"
                                                label="موبایل"
                                                type="number"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="tel"
                                                :rules="telRules"
                                                label="تلفن"
                                                type="number"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="intercom"
                                                :rules="telRules"
                                                label="داخلی"
                                                type="number"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6" v-if="more">
                                            <v-text-field
                                                v-model="email"
                                                :rules="emailRules"
                                                label="پست الکترونیک"
                                                type="email"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6" v-if="more">
                                            <v-select
                                                :items="['سایر' ,'داخلی']"
                                                label="گروه"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" md="6" v-if="more">
                                            <v-text-field
                                                type="text"
                                                v-model="date"
                                                id="my-custom-editable-input"
                                                label="تاریخ تولد"
                                                @click="show=true"
                                            ></v-text-field>
                                            <date-picker
                                                v-model="date"
                                                format="jYYYY/jMM/jDD"
                                                element="my-custom-editable-input"
                                                :editable="true"
                                                :show="show"
                                                @close="show=false"
                                                view="year"
                                                type="date"
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6" v-if="more">
                                            <v-text-field
                                                v-model="web"
                                                label="وبسایت"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" v-if="more">
                                        <v-textarea
                                            clearable
                                            clear-icon="cancel"
                                            label="آدرس"
                                            model="address"
                                            rows="1"
                                        ></v-textarea>
                                        </v-col>
                                        <v-col cols="12" v-if="more">
                                        <v-textarea
                                            clearable
                                            clear-icon="mdi-cancel"
                                            label="توضیحات"
                                            model="note"
                                            rows="2"
                                        ></v-textarea>
                                        </v-col>

                                    </v-row>
                                </v-container>
                                <small>*ضروری ها ستاره دارد</small>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn color="secondary darken-1" text @click="more=!more" v-if="!more"><v-icon>mdi-chevron-down</v-icon></v-btn>
                                <v-btn color="secondary darken-1" text @click="more=!more" v-if="more"><v-icon>mdi-chevron-up</v-icon></v-btn>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" color="success" text @click=""><v-icon>mdi-content-save</v-icon> ذخیره</v-btn>
                                <v-dialog v-model="confirmDialog" persistent max-width="290">
                                    <template v-slot:activator="{ on }">
                                        <v-btn color="dark" text v-on="on"><v-icon>mdi-close</v-icon></v-btn>
                                    </template>
                                    <v-card>
                                        <v-card-title class="headline">از بستن این پنجره اطمینان دارید؟</v-card-title>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="warning darken-1" text @click="confirmDialog = false">خیر</v-btn>
                                            <v-btn color="green darken-1" text @click="addDialog = false">بله</v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-card-actions>
                        </v-card>
                        </form>
                        <!--//Form End-->
                    </v-dialog>
                    <v-snackbar
                        v-model="snackbar"
                        :timeout="timeout"
                        color="success"
                    >
                        {{ text }}
                        <v-btn
                            color="light"
                            text
                            @click="snackbar = false"
                        >
                            باشه
                        </v-btn>
                    </v-snackbar>
                </v-container>
            </v-card>
        </v-card>

    </v-app>
</template>

<script>
    export default {
        props:['user'],
        name: "contact",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            valid: false,
            more:false,
            items: [],
            tabs: null,
            search:'',
            addDialog: false,
            confirmDialog: false,
            nameRules: [
                v => !!v || 'نام ضروری است',
            ],
            emailRules: [
                v => !!v || 'ایمیل ضروری است',
                v => /.+@.+/.test(v) || 'ایمیل صحیح وارد کنید',
            ],
            show: false,
            name: '',
            email: '',
            organization:'',
            mobile:'',
            tel:'',
            intercom:'',
            date: '',
            web: '',
            address: '',
            note: '',
            snackbar: false,
            text: 'با موفقیت ثبت شد',
            timeout: 3000,
            keyword: '',
        }),
        methods: {
            read(){
                axios.get('/contact/read')
                    .then(
                        response =>
                            this.items = response.data
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            reset () {
                    this.name= '';
                    this.email= '';
                    this.organization='';
                    this.mobile='';
                    this.tel='';
                    this.intercom='';
                    this.date= '';
                    this.web= '';
                    this.address= '';
                    this.note= '';
            },
            addContact(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };


                let formData = new FormData();

                formData.append('name', this.name);
                formData.append('_token', this.csrf);
                formData.append('email', this.email);
                formData.append('organization', this.organization);
                formData.append('tel', this.tel);
                formData.append('mobile', this.mobile);
                formData.append('intercom', this.intercom);
                formData.append('dob', this.date);
                formData.append('web', this.web);
                formData.append('address', this.address);
                formData.append('note', this.note);
                formData.append('user_id', this.user.id);
                formData.append('user_name', this.user.name);



                axios.post('/contact/add', formData, config)
                    .then(
                        response =>
                            this.items = response.data,
                            this.snackbar=true,
                            this.reset(),
                            this.addDialog=false
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
        },
        mounted() {
            this.read()
        },
        computed: {
            filteredList() {
                return this.items.filter((intercom) => {
                    return this.name.toLowerCase().split(' ').every(v => intercom.name.toLowerCase().includes(v));
                });
            },
        }
    }
</script>

<style scoped>

</style>
