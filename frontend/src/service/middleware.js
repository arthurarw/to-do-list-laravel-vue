import Cookie from '@/service/cookie';
import axios from 'axios';
import store from '@/store';

export default {
    async redirectIfNotAuthenticated(to, from, next) {
        const token = Cookie.getToken();

        if (!token) {
            next({name: 'login'});
        }

        await axios.get('v1/me').then((response) => {
            if (!store?.state?.user?.id) {
                store.commit('user/STORE_USER', response.data.data);
            }
        }).catch(() => {
            Cookie.deleteToken();
            next({name: 'login'});
        });

        next();
    },

    redirectIfAuthenticated(to, from, next) {
        const token = Cookie.getToken();
        let n;

        if (token) {
            n = {name: 'index'};
        }

        next(n);
    },
};