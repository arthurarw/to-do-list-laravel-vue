<template>
    <div>
        <h3 class="py-2 mb-8 text-gray-500 text-lg font-medium text-center">
            Recuperar senha
        </h3>

        <div
            v-if="response.message"
            :class="`rounded-sm bg-${response.color}-100 p-4 mb-4`"
        >
            <h3 :class="`text-sm leading-5 font-medium text-${response.color}-800`">
                {{ response.message }}
            </h3>
        </div>

        <ValidationObserver
            ref="resetPasswordForm"
            tag="form"
            @submit.stop.prevent="resetPassword()"
        >
            <div class="grid gap-2">
                <ValidationProvider
                    v-slot="{ errors }"
                    rules="required|email"
                    name="E-mail"
                >
                    <input
                        v-model="email"
                        type="email"
                        placeholder="Digite seu e-mail"
                        class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                    >

                    <div
                        v-if="!!errors[0]"
                        class="text-red-500 text-sm mb-2"
                    >
                        {{ errors[0] }}
                    </div>
                </ValidationProvider>

                <ValidationProvider
                    v-slot="{ errors }"
                    :rules="{ required: true, regex: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/ }"
                    name="Senha"
                >
                    <input
                        v-model="password"
                        type="password"
                        placeholder="Digite sua senha"
                        class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                    >

                    <div
                        v-if="!!errors[0]"
                        class="text-red-500 text-sm mb-2"
                    >
                        {{ errors[0] }}
                    </div>
                </ValidationProvider>

                <button
                    type="submit"
                    :disabled="spinner.reset_password"
                    class="flex items-center justify-center bg-blue-800 text-blue-200 font-medium text-sm focus:outline-none rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                >
                    <img
                        v-if="spinner.reset_password"
                        src="@/assets/img/spinner.svg"
                        alt=""
                        class="w-5 h-5 mr-2"
                    >

                    ALETRAR SENHA
                </button>

                <div class="my-4 text-center">
                    <RouterLink
                        :to="{ name: 'login' }"
                        class="text-sm font-light"
                    >
                        Login
                    </RouterLink>
                </div>
            </div>
        </ValidationObserver>
    </div>
</template>

<script>
import {ValidationObserver, ValidationProvider} from 'vee-validate';
import messages from '@/utils/messages';

export default {
    name: 'ResetPassword',

    components: {
        ValidationObserver,
        ValidationProvider,
    },

    data() {
        return {
            email: '',
            password: '',
            token: '',
            response: {
                color: '',
                message: '',
            },
            spinner: {
                reset_password: false,
            },
        };
    },

    beforeRouteEnter(to, from, next) {
        if (!to?.query?.token) {
            next({name: 'login'});
        }

        next();
    },

    created() {
        this.token = this.$route?.query?.token || '';
    },

    methods: {
        async resetPassword() {
            const validator = await this.$refs.resetPasswordForm.validate();
            if (!validator) {
                return;
            }

            this.resetResponse();

            const payload = {
                email: this.email,
                password: this.password,
                token: this.token,
            };

            this.spinner.reset_password = true;

            this.$axios.post('v1/reset-password', payload).then(() => {
                this.response.color = 'green';
                this.response.message = 'Senha alterada com sucesso! Você será redirecionado...';

                this.resetForm();

                setTimeout(() => {
                    this.$router.push({name: 'login'});
                }, 3000);
            }).catch((e) => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.color = 'red';
                this.response.message = messages[errorCode];
            }).finally(() => {
                this.spinner.reset_password = false;
            });
        },

        resetResponse() {
            this.response.color = '';
            this.response.message = '';
        },

        resetForm() {
            this.$refs.resetPasswordForm.reset();
            this.email = '';
            this.password = '';
            this.token = '';
        },
    },
};
</script>