<template>
    <div style="height: 300px;">
        <LoginMenu/>

        <div
            v-if="response.message"
            :class="`rounded-sm bg-${response.color}-100 p-4 mb-4`"
        >
            <h3 :class="`text-sm leading-5 font-medium text-${response.color}`">
                {{ response.message }}
            </h3>
        </div>

        <ValidationObserver
            ref="loginForm"
            tag="form"
            @submit.stop.prevent="login"
        >
            <div class="grid gap-2">
                <ValidationProvider
                    v-slot="{ errors }"
                    rules="required|email"
                    name="E-mail"
                >
                    <input
                        v-model="email"
                        type="text"
                        placeholder="Digite seu e-mail"
                        class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                    >

                    <div v-if="!!errors[0]" class="text-red-500 text-sm mb-2 mt-1">
                        {{ errors[0] }}
                    </div>
                </ValidationProvider>

                <ValidationProvider
                    v-slot="{ errors }"
                    rules="required"
                    name="Senha"
                >
                    <input
                        v-model="password"
                        type="password"
                        placeholder="Digite sua senha"
                        class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                    >
                    <div v-if="!!errors[0]" class="text-red-500 text-sm mb-2 mt-1">
                        {{ errors[0] }}
                    </div>
                </ValidationProvider>


                <button
                    type="submit"
                    :disabled="spinner.login"
                    class="flex items-center justify-center bg-blue-800 text-blue-200 font-medium text-sm focus:outline-none rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                >
                    <img
                        v-if="spinner.login"
                        src="@/assets/img/spinner.svg"
                        alt=""
                        class="w-5 h-5 mr-2"
                    >
                    ENTRAR
                </button>

                <div class="my-4 text-center">
                    <RouterLink
                        :to="{ name: 'forgotPassword' }"
                        class="text-sm font-light"
                    >
                        Esqueci minha senha
                    </RouterLink>
                </div>
            </div>
        </ValidationObserver>
    </div>
</template>

<script>
import LoginMenu from "@/components/Auth/LoginMenu";
import Cookie from "@/service/cookie";
import {ValidationObserver, ValidationProvider} from 'vee-validate';
import messages from '@/utils/messages';

export default {
    name: 'Login',

    components: {
        LoginMenu,
        ValidationObserver,
        ValidationProvider
    },

    data() {
        return {
            email: '',
            password: '',
            response: {
                color: '',
                message: ''
            },
            spinner: {
                login: false
            }
        };
    },

    methods: {
        async login() {
            const validator = await this.$refs.loginForm.validate();
            if (!validator) {
                return;
            }

            const payload = {
                email: this.email,
                password: this.password
            };

            this.resetResponse();

            this.spinner.login = true;

            this.$axios.post('v1/login', payload).then((response) => {
                const token = `${response.data.token_type} ${response.data.access_token}`;
                Cookie.setToken(token);

                this.$store.commit('user/STORE_USER', response.data.data);

                this.$router.push({name: 'index'});
            }).catch((e) => {
                this.spinner.login = false;
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.color = 'red';
                this.response.message = messages[errorCode];
            }).finally(() => {
                this.spinner.login = false;
            });
        },

        resetResponse() {
            this.response.color = '';
            this.response.message = '';
        }
    }

}

</script>