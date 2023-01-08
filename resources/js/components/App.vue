<template>
    <v-app :theme="theme">
        <v-app-bar>
            <v-spacer></v-spacer>
            <v-btn to="register"
                   variant="outlined"
                   color="primary"
            >Register
            </v-btn>
        </v-app-bar>

        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import {ref} from 'vue'

const theme = ref('light')

function onClick() {
    theme.value = theme.value === 'light' ? 'dark' : 'light'
}
</script>
