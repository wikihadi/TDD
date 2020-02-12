<template>
        <v-row
            justify="center"
            align="center"
        >
            <v-col
                cols="12"

            >
                <v-row
                    justify="center"
                    align="center"

                >
                    <v-col
                        cols="12"
                    >
                        <v-row

                        >
                            <v-col
                                cols="12"

                            >
                                <v-text-field
                                    :append-outer-icon="lineTwo ? 'mdi-unfold-less-horizontal' : 'mdi-unfold-more-horizontal'"
                                    @click:append-outer="lineTwo=!lineTwo"
                                    :append-icon="!lineTwo ? 'mdi-check':''"
                                    solo-inverted
                                    flat
                                    label="در حال انجام چه کاری هستی؟"
                                    prepend-inner-icon="mdi-search"
                                    v-model="content"
                                    clearable
                                    counter
                                />
                            </v-col>

                            <v-col cols="6" md="4" v-if="lineTwo">
                                <v-autocomplete
                                    :append-outer-icon="'mdi-format-list-checks'"
                                    flat
                                    v-model="values"
                                    :items="items"
                                    solo-inverted
                                    label="پروژه"
                                    clearable

                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="6" md="4" v-if="lineTwo">
                                <v-autocomplete
                                    :append-outer-icon="'mdi-clipboard-list-outline'"
                                    flat
                                    v-model="values"
                                    :items="items"
                                    label="وظیفه"
                                    solo-inverted
                                    chips
                                    small-chips
                                    multiple
                                    clearable

                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="6" md="4" v-if="lineTwo">
                                <v-autocomplete
                                    :append-outer-icon="'mdi-tag-outline'"
                                    flat
                                    v-model="values"
                                    :items="items"
                                    label="تگ"
                                    solo-inverted
                                    chips
                                    small-chips
                                    multiple
                                    clearable

                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="6" md="4" v-if="lineTwo&&showTime">
                                <v-text-field
                                    :append-outer-icon="'mdi-timer-sand-empty'"
                                    solo-inverted
                                    flat
                                    type="text"
                                    v-model="dateOn"
                                    id="dateOn"
                                    label="شروع"
                                    @click="showDateOn=true"
                                ></v-text-field>
                                <date-picker
                                    v-model="dateOn"
                                    format="jYYYY-jMM-jDD HH:mm:ss"
                                    element="dateOn"
                                    :editable="true"
                                    :show="showDateOn"
                                    @close="showDateOn=false"
                                    view="time"
                                    type="datetime"
                                    autocomplete="off"
                                />
                            </v-col>
                            <v-col cols="6" md="4" v-if="lineTwo&&showTime">
                                <v-text-field
                                    :append-outer-icon="'mdi-timer-sand-full'"
                                    solo-inverted
                                    flat
                                    type="text"
                                    v-model="dateOff"
                                    id="dateOff"
                                    label="پایان"
                                    @click="showDateOff=true"
                                ></v-text-field>
                                <date-picker
                                    v-model="dateOff"
                                    format="jYYYY-jMM-jDD HH:mm:ss"
                                    element="dateOff"
                                    :editable="true"
                                    :show="showDateOff"
                                    @close="showDateOff=false"
                                    view="time"
                                    type="datetime"
                                    autocomplete="off"
                                />
                            </v-col>
                            <v-col v-if="lineTwo" class="text-center">
                                <v-btn
                                    v-if="!showTime"
                                    @click="showTime = true"
                                    class="ma-2 white--text"
                                    flat
                                    fab
                                    dark small
                                ><v-icon dark>mdi-timer</v-icon>
                                </v-btn>
                                <v-btn
                                    v-if="showTime"
                                    color="secondary"
                                    class="ma-2 white--text"
                                    @click="showTime = false,dateOff=null,dateOn=null"
                                    flat
                                    fab
                                    dark small
                                ><v-icon>mdi-close</v-icon>
                                </v-btn>

                                <v-btn
                                    v-if="!showTime&&!played"
                                    color="success"
                                    class="ma-2 white--text"
                                    flat
                                    fab
                                    dark small
                                    @click.prevent="palyed = true"
                                >
                                    <v-icon>mdi-play</v-icon>
                                </v-btn>
                                <v-btn
                                    v-if="!showTime&&played"
                                    color="warning"
                                    class="ma-2 white--text"
                                    flat
                                    fab
                                    dark small
                                    @click.prevent="palyed = false"

                                >
                                    <v-icon>mdi-stop</v-icon>
                                </v-btn>
                                <v-btn
                                    :loading="loading5"
                                    :disabled="loading5"
                                    color="primary"
                                    class="ma-2 white--text"
                                    @click="loader = 'loading5'"
                                    flat
                                    fab
                                    small
                                ><v-icon dark>mdi-check</v-icon>
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>

</template>

<script>
    export default {
        name: "Dashboard",
        data () {
            return {
                showTime:false,
                played:false,
                dateOn:'',
                dateOff:'',
                items: ['foo', 'bar', 'fizz', 'buzz'],
                values: ['foo', 'bar'],
                value: null,
                lineTwo: false,
                loader: null,
                loading5: false,
                showDateOn:false,
                showDateOff:false,
            }
        },
        watch: {
            loader () {
                const l = this.loader
                this[l] = !this[l]

                setTimeout(() => (this[l] = false), 3000)

                this.loader = null
            },
        },
    }
</script>

<style scoped>
    .custom-loader {
        animation: loader 1s infinite;
        display: flex;
    }
    @-moz-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-webkit-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-o-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
