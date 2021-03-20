<template>
    <ValidationObserver
        ref="todoUpdateForm"
        tag="form"
        @submit.stop.prevent="onSave"
    >
        <div class="flex items-center bg-gray-300 rounded-sm px-4 h-16 mb-2">
            <ValidationProvider
                v-slot="{ errors }"
                rules="required"
                name="Label"
                class="w-full mr-3"
            >
                <input
                    v-model="localLabel"
                    ref="label"
                    type="text"
                    placeholder="Digite o nome da sua lista ..."
                    class="bg-gray-300 placeholder-gray-500 text-gray-700 font-light focus:outline-none block w-full appearance-none leading-normal"
                >

                <div
                    v-if="!!errors[0]"
                    class="text-red-500 text-sm mb-2"
                >
                    {{ errors[0] }}
                </div>
            </ValidationProvider>

            <div class="flex items-center ml-auto">
                <a
                    href=""
                    class="text-xs text-gray-900 mr-2 focus:outline-none"
                    @click.stop.prevent="onCancel()"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="bg-blue-700 text-blue-100 text-xs font-semibold px-2.5 py-1 rounded focus:outline-none"
                >
                    OK
                </button>
            </div>
        </div>
    </ValidationObserver>
</template>

<script>
    import {ValidationObserver, ValidationProvider} from 'vee-validate';

    export default {
        name: 'TodoCardUpdate',

        components: {
            ValidationObserver,
            ValidationProvider,
        },

        props: {
            todo: {
                type: Object,
                default: () => ({}),
            },
        },

        data() {
            return {
                localLabel: this.todo.label,
            };
        },

        mounted() {
            this.$refs.label.focus();
        },

        methods: {
            onCancel() {
                this.$emit('cancel');
            },

            async onSave() {
                const validator = await this.$refs.todoUpdateForm.validate();
                if (!validator) {
                    return;
                }

                const payload = {
                    label: this.localLabel,
                };

                this.$axios.put(`v1/todos/${this.todo.id}`, payload).then(() => {
                    this.todo.label = this.localLabel;
                    this.onCancel();
                });
            },
        },
    };
</script>

<style scoped>

</style>
