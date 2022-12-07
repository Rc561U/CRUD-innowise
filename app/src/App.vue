<template>
    <v-app>
        <div>
            <nav-bar/>
            <!--        Snackbar -->
            <div class="user_alerts">
                <v-snackbar
                    v-model="snackbar"
                    :timeout="5000"
                    :location="'bottom left'"
                >
                    {{ alert_text }}
                    <template v-slot:actions>
                        <v-btn
                            color="red"
                            variant="text"
                            @click="snackbar = false"
                        >
                            Close
                        </v-btn>
                    </template>
                </v-snackbar>
            </div>
            <div v-if="users.length > 0">

                <!--        Basic card -->
                <v-card
                    class="mx-auto"
                    id="main_card"
                    width="max-content"
                    height="max-content"
                >

                    <!--   Card Header -->
                    <div class="label-header">
                        <h1>Reed information</h1>
                        <v-icon style="margin: 10px; padding-right: 20px"
                                icon="mdi-book-open-page-variant mdi-48px "></v-icon>
                    </div>
                    <div class="actions-header">
                        <CreatePost v-model="showScheduleForm" @create="createPost"/>
                    </div>

                    <!--            Progress bar linear -->
                    <v-progress-linear
                        elevation="0"
                        :active="loading"
                        :indeterminate="loading"
                        indeterminate
                        color="primary"
                        @update:modelValue="page"
                    ></v-progress-linear>

                    <!--            Main data table component -->
                    <v-row align="stretch">
                        <v-col
                            class="d-flex justify-center align-center"
                        >
                            <users-table
                                v-bind:users="users"
                                v-bind:page="page"
                                v-on:remove="removeUser"
                                v-on:update="updateUser"
                            />
                        </v-col>
                    </v-row>

                    <!--            Pagination -->
                    <div class="text-center">
                        <v-pagination

                            v-model="page"
                            :length="totalPages"
                            :total-visible="8"
                            @update:modelValue="changePage"
                            @click="loading = true"
                        ></v-pagination>
                    </div>
                </v-card>

            </div>
            <v-progress-circular v-else
                                 indeterminate
                                 class="progress_error"
                                 :size="80"
                                 :width="7"
                                 color="indigo darken-4"
            ></v-progress-circular>
        </div>
    </v-app>
</template>
<script>
import UsersTable from "@/components/UsersTable.vue";
import axios from "axios";
import {tr} from "vuetify/locale";
import CreatePost from "@/components/CreatePost.vue";
import NavBar from "@/components/NavBar.vue";

export default {
    name: 'App',
    computed: {
        tr() {
            return tr
        }
    },
    components: {
        UsersTable, CreatePost, NavBar
    },
    data: () => ({
        users: [],
        page: 1,
        limit: 15,
        totalPages: 0,
        loading: false,
        dialog: false,
        showScheduleForm: false,
        alert_text: '',
        snackbar: false,

    }),
    methods: {
        async fetchUsers() {
            try {
                const response = await axios.get("http://localhost/api/users?page=2", {
                    params: {
                        page: this.page,
                        per_page: this.limit
                    },
                });
                this.users = response.data;
                this.totalPages = Math.ceil(response.headers['x-pagination-total'] / this.limit)

            } catch (e) {
                this.alert_text = `Server is not available`;
                this.snackbar = true;
            }
        },

        changePage() {
            this.user = []
            this.fetchUsers()
        },

        createPost(user) {
            axios.post('http://localhost/api/users/', user)
                .then((response) => {
                    console.log(response)
                    if (response.data instanceof Array) {
                        this.alert_text = `Email ${response.data[0].message}`;
                    }
                    else {
                        this.alert_text = `New user has been created`;
                        console.log(response.data)
                    }
                    this.snackbar = true;
                    this.fetchUsers();
                })
                .catch(function (error) {
                    this.alert_text = `Server is not available`;
                    this.snackbar = true;
                });


        },
        removeUser(user) {
            axios.delete(`http://localhost/api/users/${user.id}`)
                .then(response => {
                    this.users = this.users.filter(p => p.id !== user.id)
                    this.fetchUsers()
                    this.alert_text = `User ${user.name} has been deleted`
                    this.snackbar = true

                });
        },
        updateUser(user) {
            axios.patch(`http://localhost/api/users/${user.id}`,
                user, {headers: {'Content-Type': 'application/json'}},
            ).then((response) => {
                if (response.data instanceof Array) {
                    this.alert_text = `Email ${response.data[0].message}`;
                }
                else {
                    this.alert_text = `User data has been successfully updated`;
                }
                this.snackbar = true;
                this.fetchUsers();
            }).catch((error) => {
                this.alert_text = `Server is not available`;
                this.snackbar = true;
            })

        },
    },
    mounted() {
        this.fetchUsers();
    },
    watch: {
        loading(val) {
            if (!val) return
            setTimeout(() => (this.loading = false), 2000)
        },
    },
}
</script>
<style>
.label-header {
    display: flex;
    justify-content: space-between;
    padding-left: 10px;
    padding-top: 10px;
}

.actions-header {
    display: flex;
    justify-content: space-between;
    padding: 20px;
}

#main_card {
    margin-top: 100px;
}

.progress_error {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}
</style>
