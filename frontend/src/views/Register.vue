<template>
    <div style="height: 300px;">
        <LoginMenu/>

        <div
            v-if="response.message"
            :class="`rounded-sm bg-${response.color}-100 p-4 mb-4`"
        >
            <h3 :class="`text-sm leading-5 font-medium text-${response.color}-800`">
                {{ response.message }}
            </h3>
        </div>

        <ValidationObserver
            ref="registerForm"
            tag="form"
            @submit.stop.prevent="register()"
        >
            <div class="grid gap-2">
                <div class="flex">
                    <div class="w-1/2 mr-2">

                        <ValidationProvider
                            v-slot="{ errors }"
                            rules="required"
                            name="Primeiro nome"
                        >
                            <input
                                v-model="firstName"
                                type="text"
                                placeholder="Digite seu nome"
                                class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                            >
                            <div
                                v-if="!!errors[0]"
                                class="text-red-500 text-sm mb-2"
                            >
                                {{ errors[0] }}
                            </div>
                        </ValidationProvider>
                    </div>

                    <div class="w-1/2  ml-2">
                        <input
                            v-model="lastName"
                            type="text"
                            placeholder="Digite seu sobrenome"
                            class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                        >
                    </div>
                </div>

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
                    :disabled="spinner.register"
                    class="flex items-center justify-center bg-blue-800 text-blue-200 font-medium text-sm focus:outline-none rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                >
                    <img
                        v-if="spinner.register"
                        src="@/assets/img/spinner.svg"
                        alt=""
                        class="w-5 h-5 mr-2"
                    >
                    REGISTRAR
                </button>
            </div>

        </ValidationObserver>
    </div>
</template>

<script>
import LoginMenu from '@/components/Auth/LoginMenu';
import {ValidationObserver, ValidationProvider} from 'vee-validate';
import messages from "@/utils/messages";
// import messages from '@/utils/messages';

export default {
    name: 'Register',

    components: {
        LoginMenu,
        ValidationObserver,
        ValidationProvider,
    },

    data() {
        return {
            firstName: '',
            lastName: '',
            email: '',
            password: '',
            response: {
                color: '',
                message: '',
            },
            spinner: {
                register: false,
            },
        };
    },

    methods: {
        async register() {
            const validator = await this.$refs.registerForm.validate();
            if (!validator) {
                return;
            }

            this.resetResponse();

            const payload = {
                firstname: this.firstName,
                lastname: this.lastName,
                email: this.email,
                password: this.password
            };

            this.spinner.register = true;

            this.$axios.post('v1/register', payload).then((response) => {
                this.response.color = 'green';
                this.response.message = 'Seu cadastro foi feito com sucesso.';

                this.resetForm();
            }).catch((e) => {
                this.spinner.register = false;
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.color = 'red';
                this.response.message = messages[errorCode];
            }).finally(() => {
                this.spinner.register = false;
            });


        },

        resetResponse() {
            this.response.color = '';
            this.response.message = '';
        },

        resetForm() {
            this.$refs.registerForm.reset();
            this.firstName = '';
            this.lastName = '';
            this.email = '';
            this.password = '';
        },
    }


};
</script>