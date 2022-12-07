<template>
            <v-app-bar
                color="teal-darken-4"
                image="https://picsum.photos/1920/1080?random"

            >
                <template v-slot:image>
                    <v-img
                        gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
                    ></v-img>
                </template>
                    <v-app-bar-title>CRUD-Vue-Vuetify</v-app-bar-title>

                    <v-btn icon href="http://localhost/users" value="recent">
                        <v-icon>mdi-keyboard-return</v-icon>
                    </v-btn>
            </v-app-bar>
</template>

<script>
export default {
    name: "NavBar"
}
</script>
<style scoped>
.nav-bar-items {
    text-align: center;
}
</style>