<template>
    <v-alert
        v-show="errors"
        icon="mdi-cloud-alert"
        prominent
        title=""
        type="error"
        variant="text"
    >
        <ul>
            <li v-for="error in errors.errors">{{ error[0] }}</li>
        </ul>
    </v-alert>
    <v-alert
        v-show="success"
        color="yellow-darken-4"
        icon="mdi-flash"
        title="Flat (Default)"
        variant="flat"
    >
        You have successfully registered.
    </v-alert>
    <v-form
        ref="form"
        @submit.prevent="submit"
    >
        <v-text-field
            v-model="name"
            label="Name"
            required
        ></v-text-field>

        <v-text-field
            v-model="email"
            label="E-mail"
            required
        ></v-text-field>

        <v-text-field
            v-model="password"
            type="password"
            label="Password"
            required
        ></v-text-field>

        <v-text-field
            v-model="phone"
            label="phone"
            required
        ></v-text-field>

        <v-select
            v-model="position_id"
            :items="positions"
            item-title="name"
            item-value="id"
            label="Positions"
            required
        ></v-select>

        <v-file-input
            accept=".jpeg, .jpg"
            placeholder="Pick an avatar"
            prepend-icon="mdi-camera"
            label="Avatar"
            ref="photo"
        ></v-file-input>

        <v-btn
            color="success"
            class="mr-4"
            type="submit"
        >
            Submit
        </v-btn>
    </v-form>
</template>

<script>
export default {
    name: "Register",
    data: () => ({
        name: '',
        email: '',
        phone: '',
        photo: '',
        password: '',
        position_id: '',
        positions: [],
        token: '',
        errors: [],
        success: false
    }),
    beforeMount() {
        this.getPositions();
    },
    methods: {
        getPositions() {
            axios.get('/api/v1/positions').then(res => {
                this.positions = res.data.positions;
            });
        },
        getToken() {
            axios.get('/api/v1/token').then(res => {
                this.token = res.data.token;
            });
        },
        submit() {
            this.getToken();
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('phone', this.phone);
            formData.append('password', this.password);
            formData.append('position_id', this.position_id);
            formData.append('photo', this.$refs.photo.files[0]);
            axios.post('/api/v1/users', formData, {
                headers: {
                    Token: this.token
                }
            }).then(res => {
                this.token = '';
                this.name = '';
                this.email = '';
                this.phone = '';
                this.password = '';
                this.position_id = '';
                this.photo = '';
                this.errors = [];
                this.success = true;
            }).catch(error => {
                this.errors = error.response.data;
            });
        }
    }
}
</script>
