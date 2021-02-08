import Vue from 'vue';
import VueRouter from 'vue-router';
import LayoutAuth from '@/layouts/Auth';
import Login from '@/views/Login';
import Register from '@/views/Register';
import VerifyEmail from '@/views/VerifyEmail';
import ForgotPassword from '@/views/ForgotPassword';
import ResetPassword from '@/views/ResetPassword';

Vue.use(VueRouter);

const routes = [
    {
        path: '/login', component: LayoutAuth,
        children: [
            {path: '', name: 'login', component: Login},
        ],
    },

    {
        path: '/cadastro', component: LayoutAuth,
        children: [
            {path: '', name: 'register', component: Register},
        ],
    },

    {
        path: '/verificar-email', component: LayoutAuth,
        children: [
            {path: '', name: 'verifyEmail', component: VerifyEmail},
        ],
    },

    {
        path: '/esqueci-minha-senha', component: LayoutAuth,
        children: [
            {path: '', name: 'forgotPassword', component: ForgotPassword},
        ],
    },

    {
        path: '/recuperar-senha', component: LayoutAuth,
        children: [
            {path: '', name: 'resetPassword', component: ResetPassword},
        ],
    },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
});

export default router;
