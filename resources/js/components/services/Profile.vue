<template>
    <v-app>
        <v-card
            class=""
            width="100%"
            outlined
        >
            <v-avatar size="100%">
                <div class="text-center">
                <img
                    :src="'/storage/avatar/' + user.avatar"
                    :alt="user.name"
                >

                </div>
            </v-avatar>
            <!--<v-card-title class="text-center"></v-card-title>-->

            <!--<v-card-subtitle class="pb-0" class="text-right">{{user.id}}</v-card-subtitle>-->

            <v-card-text class="text--primary text-center">
                <h4 class="text-center">{{user.name}}</h4>
                <div>{{user.email}}</div>
            </v-card-text>
            <v-btn text block  x-small flat color="primary" @click.stop="edit">
ویرایش            </v-btn>
        </v-card>

        <!--Profile Edit Modal-->
        <v-dialog
            v-model="dialog"
            max-width="500"
        >
            <v-card>
                <v-card-title class="headline">ویرایش پروفایل کاربری</v-card-title>

                <v-card-text>
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <v-file-input
                            v-model="file"
                            :rules="avatarRules"
                            accept="image/png, image/jpeg, image/bmp"
                            prepend-icon="mdi-account-circle-outline"
                            label="آواتار"
                        ></v-file-input>
                        <v-text-field
                            v-model="name"
                            :rules="nameRules"
                            label="نام"
                            required
                            prepend-icon="mdi-account"
                        ></v-text-field>

                        <v-text-field
                            v-model="email"
                            :rules="emailRules"
                            label="پست الکترونیک"
                            required
                            disabled
                            prepend-icon="mdi-email"
                        ></v-text-field>

                        <v-checkbox
                            v-model="checkbox"
                            :rules="[v => !!v || 'لطفا تایید کنید!']"
                            label="قوانین و مقررات سازمانی را مطالعه کرده ام"
                            required
                        ></v-checkbox>

                        <v-btn
                            :disabled="!valid"
                            color="success"
                            class="mr-4"
                            @click="validate"
                            text
                        >
                            ویرایش
                        </v-btn>

                    </v-form>
                </v-card-text>

            </v-card>
        </v-dialog>

    </v-app>
</template>

<script>
    export default {
        name: "Profile",
        props:['user'],
        data: () => ({
            dialog:false,
            valid: true,
            name: '',
            nameRules: [
                v => !!v || 'نام ضروری است',
            ],
            email: '',
            file: null,
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            avatarRules: [
                value => !value || value.size < 500000 || 'کمتر از 500 کیلوبایت!',
            ],
            checkbox: false,
        }),
        mounted: function () {

        },
        methods: {
            validate () {
                if (this.$refs.form.validate()) {
                    this.snackbar = true
                }
            },
            edit(){
                this.dialog=true;
                this.name=this.user.name;
                this.email=this.user.email;
            }
        },
    }
</script>

<style scoped>

</style>
