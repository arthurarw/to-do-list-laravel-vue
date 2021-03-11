<template>
    <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="text-gray-500 font-medium">
                Meu perfil
            </div>
        </div>

        <div
            v-if="response.message"
            :class="`rounded-sm bg-${response.color}-100 p-4 mb-4`"
        >
            <h3 :class="`text-sm leading-5 font-medium text-${response.color}-800`">
                {{ response.message }}
            </h3>
        </div>

        <ValidationObserver
            ref="profileForm"
            tag="form"
            @submit.stop.prevent="update"
        >
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <ValidationProvider
                        v-slot="{ errors }"
                        rules="required"
                        name="Primeiro nome"
                        tag="div"
                    >
                        <label
                            for="firstName"
                            class="block text-sm text-gray-500 font-medium mb-2"
                        >
                            Primeiro nome
                        </label>

                        <input
                            id="firstName"
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

                <div>
                    <label
                        for="lastName"
                        class="block text-sm text-gray-500 font-medium mb-2"
                    >
                        Sobrenome
                    </label>

                    <input
                        id="lastName"
                        v-model="lastName"
                        type="text"
                        placeholder="Digite seu sobrenome"
                        class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light border border-gray-900 focus:outline-none focus:border-blue-800 rounded-sm py-3 px-4 block w-full appearance-none leading-normal"
                    >
                </div>

                <div>
                    <ValidationProvider
                        v-slot="{ errors }"
                        rules="required|email"
                        name="Email"
                        tag="div"
                    >
                        <label
                            for="email"
                            class="block text-sm text-gray-500 font-medium mb-2"
                        >
                            E-mail
                        </label>

                        <input
                            id="email"
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
                </div>

                <div>
                    <ValidationProvider
                        v-slot="{ errors }"
                        :rules="{ regex: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/ }"
                        name="Senha"
                    >
                        <label
                            for="password"
                            class="block text-sm text-gray-500 font-medium mb-2"
                        >
                            Senha
                        </label>

                        <input
                            id="password"
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
                </div>

                <div class="col-span-2 text-right">
                    <button
                        type="submit"
                        :disabled="spinner.update_user"
                        class="inline-flex items-center justify-center bg-blue-800 text-blue-200 font-medium text-sm focus:outline-none rounded-sm py-3 px-4 inline-block appearance-none leading-normal"
                    >
                        <img
                            v-if="spinner.update_user"
                            src="@/assets/img/spinner.svg"
                            alt=""
                            class="w-5 h-5 mr-2"
                        >

                        SALVAR
                    </button>
                </div>
            </div>
        </ValidationObserver>
    </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import { ValidationObserver, ValidationProvider } from 'vee-validate';
import messages from '@/utils/messages';

export default {
    name: 'Profile',

    components: {
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
                update_user: false,
            },
        };
    },

    computed: {
        ...mapState({
            user: state => state.user.user,
        }),
    },

    created() {
        this.firstName = this.user.firstname;
        this.lastName = this.user.lastname;
        this.email = this.user.email;
    },

    methods: {
        ...mapMutations('user', ['STORE_USER']),

        async update() {
            const validator = await this.$refs.profileForm.validate();
            if (!validator) { return; }

            const payload = {
                firstname: this.firstName,
                lastname: this.lastName,
                email: this.email,
            };

            if (this.password) {
                payload.password = this.password;
            }

            this.spinner.update_user = true;
            this.$axios.put('v1/me', payload).then((response) => {
                this.response.color = 'green';
                this.response.message = 'Seus dados foram atualizados com sucesso!';

                this.STORE_USER(response.data.data);
            }).catch((e) => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.color = 'red';
                this.response.message = messages[errorCode];
            }).finally(() => {
                this.spinner.update_user = false;
            });
        }
    },
};
</script>
