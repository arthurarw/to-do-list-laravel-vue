<template>
    <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="text-gray-500 font-medium">
                Lista de tarefas
            </div>
        </div>

        <form
            class="flex items-center px-4 bg-gray-300 h-15 rounded-sm mb-3"
            @submit.stop.prevent="createTodo"
        >
            <input
                v-model="newTodo"
                placeholder="Digite o nome da sua lista ..."
                type="text"
                class="bg-gray-300 placeholder-gray-500 text-gray-700 font-light focus:outline-none block w-full appearance-none leading-normal pr-3 pt-5 pb-5"
            >

            <button
                type="submit"
                class="text-blue-700 text-xs font-semibold focus:outline-none"
            >
                ADICIONAR
            </button>
        </form>

        <div
            v-if="spinner.get_todos"
            class="text-center"
        >
            <img
                src="@/assets/img/spinner.svg"
                alt=""
                class="inline-block w-5 h-5"
            >
        </div>

        <div v-for="todo in todos" :key="todo.id"
        class="flex items-center justify-between bg-gray-300 rounded-sm p-2 h-15 mb-2">
            <div>
                <input type="text" v-model="todo.label" @keyup.enter="updateTodo(todo)">
                <button @click.stop.prevent="destroyTodo(todo)">x</button>
            </div>
        </div>


    </div>
</template>

<script>

export default {
    name: 'Home',

    data() {
        return {
            newTodo: '',
            todos: [],
            spinner: {
                get_todos: false,
            },
        };
    },

    created() {
        this.getTodos();
    },

    methods: {
        getTodos() {
            this.spinner.get_todos = true;
            this.$axios.get('v1/todos').then((response) => {
                this.todos = response.data.data.map((o) => ({
                    ...o,
                    state: 'show',
                }));
            }).finally(() => {
                this.spinner.get_todos = false;
            });
        },

        createTodo() {
            if (!this.newTodo) { return; }

            const payload = {
                label: this.newTodo,
            };

            this.$axios.post('v1/todos', payload).then((response) => {
                this.todos.unshift({ ...response.data.data, state: 'show' });
                this.newTodo = '';
            });
        },

        updateTodo(todo) {
            const payload = {
                label: todo.label
            };

            this.$axios.put(`v1/todos/${todo.id}`, payload);
        },

        destroyTodo(todo) {
            this.$axios.delete(`v1/todos/${todo.id}`).then(() => {
                this.afterDeleting(todo);
            });
        },

        afterDeleting(todo) {
            const idx = this.todos.findIndex(o => o.id === todo.id);
            this.todos.splice(idx, 1);
        },
    },



    };
</script>
