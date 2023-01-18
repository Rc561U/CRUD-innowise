<template>
    <v-dialog
        v-model="dialog"
        width="400"
    >
        <template v-slot:activator="{ props }">
            <v-btn
                v-bind="props"
                variant="text"
            ><v-icon icon="mdi-delete"></v-icon>
            </v-btn>
        </template>
        <v-card >
            <v-card-title class="text-h5 text-center">
                Are you sure?
            </v-card-title>
            <v-card-text class="text-center">This User will be completely deleted</v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue lighten-1"
                    variant="text"
                    @click="dialog = false"
                >
                    Disagree
                </v-btn>
                <v-btn
                    color="red darken-4"
                    variant="text"
                    @click="deleteUser"
                >
                    Agree
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    data() {
        return {
            dialog: false,
        }
    },
    name: "DeleteUserDialog",
    props: {
        user: {
            required: true
        },
    },
    methods: {
        deleteUser() {
            this.$emit('remove', this.user)
            this.dialog = false
        }
    },
}
</script>
