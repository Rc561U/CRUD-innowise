<template >
    <div class="text-center">
        <v-dialog
            v-model="dialog"
            width="500"
        >
            <template v-slot:activator="{ props }">
                <v-btn
                    v-bind="props"
                    style="margin: 10px"
                ><v-icon style="padding-right: 20px" icon="mdi-account-plus mdi-36px"></v-icon> Create new User
                </v-btn>
            </template>
            <v-card>
                <v-form
                    ref="form"
                    class="pa-4 pt-6"
                    id="create_form"
                    lazy-validation
                >
                    <h2>Create new User</h2>
                    <v-textarea
                        label="Email"
                        auto-grow
                        rows="1"
                        row-height="15"
                        :rules="emailRules"
                        v-model="user.email"
                    ></v-textarea>

                    <v-textarea
                        variant="filled"
                        auto-grow
                        label="Full Name"
                        :rules="nameRules"
                        rows="1"
                        row-height="30"
                        v-model="user.name"
                        shaped
                    ></v-textarea>
                    <v-select
                        :items="genders"
                        label="Gender"
                        v-model="user.gender"
                        :rules="[v => !!v || 'Item is required']"
                        dense
                    ></v-select>
                    <v-select
                        type="string"
                        :items="user_statuses"
                        v-model="user.status"
                        label="Status"
                        :rules="[v => !!v || 'Item is required']"
                        dense
                    ></v-select>

                    <v-btn
                        color="teal"
                        @click="validate"
                        style="margin-right: 20px"
                    >
                        Submit
                    </v-btn>
                    <v-btn @click="dialog = false"> Cancel </v-btn>
                </v-form>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            user: {},
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            email: '',
            name: '',
            genders: ['Male','Female'],
            user_statuses: ['Active','Inactive']
        }
    },
    methods: {
        async validate () {
            const { valid } = await this.$refs.form.validate()

            if (valid) {
                this.$emit('create', this.user)
                this.dialog = false
            }
        },
    },
}
</script>
