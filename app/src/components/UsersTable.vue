<template>
        <v-table
            density="comfortable"
            hover=hover
        >
            <thead>
            <tr>
                <th><v-icon>mdi-format-list-checks</v-icon></th>
                <th class="text-left">ID</th>
                <th class="text-left">Name</th>
                <th class="text-left">Email</th>
                <th class="text-left">Gender</th>
                <th class="text-left">Status</th>
                <th class="text-left">Actions</th>
            </tr>
            </thead>
            <tbody>

            <transition-group name="post_list" >
            <tr
                v-for="(user, index) in users"
                :key="user.id"
            >
                <td v-if="page === 1">{{  + index +1  }}</td>
                <td v-else>{{ (15 * (page - 1)) + index +1  }}</td>
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.gender }}</td>
                <td>{{ user.status }}</td>
                <td>
                    <edit-post
                        :user="user"
                        @update="test"
                    />

                    <delete-user-dialog
                        v-bind:user="user"
                        @remove="$emit('remove', user)"
                    />
                </td>
            </tr>
            </transition-group>
            </tbody>
        </v-table>
</template>

<script>
import DeleteUserDialog from "@/components/DeleteUserDialog.vue";
import EditPost from "@/components/EditPost.vue";

export default {
    name: "UsersTable",
    props: {
        users: {
            required: true
        },
        page: {
            required: true
        }

    },
    components: {
        DeleteUserDialog,EditPost
    },
    data: () => ({
        loading: false,
    }),
    methods: {
        test(user) {
            this.$emit('update', user)
        },
        progress(user) {
        }
    },
    watch: {
        users: function () {
            return setTimeout(() => (this.loading = false), 1000)
        },
    },
    computed: {}
}
</script>

<style scoped>
.post_list-move, /* apply transition to moving elements */
.post_list-enter-active,
.post_list-leave-active {
  transition: all 0.5s ease;
}

.post_list-enter-from,
.post_list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.post_list-leave-active {
  position: absolute;
}
</style>