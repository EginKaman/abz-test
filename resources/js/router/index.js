import { createWebHistory, createRouter } from 'vue-router'
// import store from '@/store'

/* Guest Component */
// const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

/* Layouts */
const AppLayout = () => import('@/components/App.vue')
/* Layouts */

/* Authenticated Component */
const Users = () => import('@/components/Users.vue')
/* Authenticated Component */


const routes = [
    // {
    //     name: "login",
    //     path: "/login",
    //     component: Login,
    //     meta: {
    //         middleware: "guest",
    //         title: `Login`
    //     }
    // },
    {
        path: "/",
        component: AppLayout,
        children: [
            {
                name: "users",
                path: '/',
                component: Users,
                meta: {
                    title: `Users`
                }
            },
            {
                name: "register",
                path: '/register',
                component: Register,
                meta: {
                    title: `Register`
                }
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})
export default router
