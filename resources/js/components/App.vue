<template>
    <v-app :theme="theme">
        <v-app-bar>
            <v-spacer></v-spacer>
            <router-link to="register">Register</router-link>
            <v-btn
                :prepend-icon="theme === 'light' ? 'mdi-weather-sunny' : 'mdi-weather-night'"
                @click="onClick"
            >Toggle Theme</v-btn>
        </v-app-bar>

        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { ref } from 'vue'

const theme = ref('light')

function onClick () {
    theme.value = theme.value === 'light' ? 'dark' : 'light'
}
</script>
