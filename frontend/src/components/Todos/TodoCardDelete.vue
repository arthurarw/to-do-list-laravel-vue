<template>
    <div class="flex items-center justify-between bg-red-100 rounded-sm px-4 h-16 mb-2">
        <div class="text-red-900 font-light truncate">
            Deseja excluir <b>"{{ todo.label }}"</b>?
        </div>

        <div class="flex items-center">
            <a
                href=""
                class="text-xs text-red-900 mr-2 focus:outline-none"
                @click.stop.prevent="onCancel()"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="bg-red-700 text-red-100 text-xs font-semibold px-2.5 py-1 rounded focus:outline-none"
                @click.stop.prevent="onDelete()"
            >
                SIM
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TodoCardDelete',

        props: {
            todo: {
                type: Object,
                default: () => ({}),
            },
        },

        data() {
            return {
            };
        },

        methods: {
            onCancel() {
                this.$emit('cancel');
            },

            onDelete() {
                this.$axios.delete(`v1/todos/${this.todo.id}`).then(() => {
                    this.$emit('afterDeleting', this.todo);
                });
            },
        },
    };
</script>
