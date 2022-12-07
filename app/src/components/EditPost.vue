<template>
    <v-dialog
        v-model="dialog"
        width="500"
    >
        <template v-slot:activator="{ props }">
            <v-btn
                v-bind="props"
                variant="text"
            >
                <v-icon icon="mdi-pen"></v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-form
                ref="form"
                class="pa-4 pt-6"
                id="create_form"
                lazy-validation
            >
                <h2>Edit User Data</h2>
                <v-textarea
                    label="Email"
                    auto-grow
                    variant="filled"
                    rows="1"
                    row-height="15"
                    :rules="emailRules"
                    v-model="editEmail"
                ></v-textarea>

                <v-textarea
                    variant="filled"
                    auto-grow
                    label="Full Name"
                    :rules="nameRules"
                    rows="1"
                    row-height="30"
                    v-model="editName"
                    shaped
                ></v-textarea>
                <v-select
                    :items="genders"
                    variant="filled"
                    label="Gender"
                    v-model="editGender"
                    :rules="[v => !!v || 'Item is required']"
                    dense
                ></v-select>
                <v-select
                    :items="user_statuses"
                    variant="filled"
                    v-model="editStatus"
                    label="Status"
                    :rules="[v => !!v || 'Item is required']"
                    dense
                ></v-select>

                <v-btn
                    color="teal"
                    @click="validate"
                    class="mr-3"
                >
                    Submit
                </v-btn>

                <v-btn @click="dialog = false"> Cancel</v-btn>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "EditPost",
    data() {
        return {
            dialog: false,
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 30) || 'Name must be less than 10 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            editId: "",
            editEmail: "",
            editName: '',
            editGender: '',
            editStatus: '',
            genders: ['Male', 'Female'],
            user_statuses: ['Active', 'Inactive']
        }
    },
    props: {
        user: {},
    },

    methods: {
        updateUser() {
            this.$emit('update', this.user)
            this.dialog = false
        },
        async validate() {
            const {valid} = await this.$refs.form.validate()

            if (valid) {
                let updatedUser = {id: this.editId, name: this.editName, email:this.editEmail, gender:this.editGender, status:this.editStatus}
                this.$emit('update', updatedUser)
                this.dialog = false
            }
        },

    },
    mounted() {
        this.editId = this.user.id;
        this.editEmail = this.user.email;
        this.editName = this.user.name;
        this.editGender = this.user.gender;
        this.editStatus = this.user.status;
    }
}
</script>
