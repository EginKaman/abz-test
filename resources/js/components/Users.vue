<template>
    <div>
        <v-table density="compact">
            <thead>
            <tr>
                <th class="text-left">
                    Name
                </th>
                <th class="text-left">
                    E-mail
                </th>
                <th class="text-left">
                    Phone
                </th>
                <th class="text-left">
                    Position
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="user in users"
                :key="user.id"
            >
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.position }}</td>
            </tr>
            </tbody>
        </v-table>
        <v-btn @click="showMore" v-if="links.next">Show more</v-btn>
    </div>
</template>

<script>

export default {
    name: "Users",
    data() {
        return {
            users: {},
            links: {}
        }
    },
    beforeMount() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            axios.get('/api/v1/users').then(res => {
                this.users = res.data.users;
                this.links = res.data.links;
            });
        },
        showMore() {
            axios.get(this.links.next).then(res => {
                this.users = [...this.users, ...res.data.users];
                this.links = res.data.links
            });
        }
    }
}
</script>

<style scoped>

</style>
