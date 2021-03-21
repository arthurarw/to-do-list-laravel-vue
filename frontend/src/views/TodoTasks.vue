<template>
    <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto">
        <div
            v-if="spinner.get_todo"
            class="text-center"
        >
            <img
                src="@/assets/img/spinner.svg"
                alt=""
                class="inline-block w-5 h-5"
            >
        </div>

        <template v-else>
            <div class="flex items-center mb-8">
                <RouterLink
                    :to="{ name: 'index' }"
                    class="-ml-2"
                >
                    <svg
                        class="h-5 w-5 text-gray-500 mr-2"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7071 5.29289C13.0976 5.68342 13.0976 6.31658 12.7071 6.70711L9.41421 10L12.7071 13.2929C13.0976 13.6834 13.0976 14.3166 12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L7.29289 10.7071C6.90237 10.3166 6.90237 9.68342 7.29289 9.29289L11.2929 5.29289C11.6834 4.90237 12.3166 4.90237 12.7071 5.29289Z"
                            fill="currentColor"
                        />
                    </svg>
                </RouterLink>

                <div class="text-gray-500 font-medium">
                    {{ todo.label }}
                </div>
            </div>

            <form
                class="flex items-center px-4 bg-gray-900 h-15 rounded-sm border-l-2 border-green-400 mb-3"
                @submit.stop.prevent="addTask"
            >
                <input
                    v-model="newTask"
                    placeholder="Adicione um novo item ..."
                    type="text"
                    class="bg-gray-900 placeholder-gray-700 text-gray-500 font-light focus:outline-none block w-full appearance-none leading-normal pr-3 pt-5 pb-5"
                >

                <button
                    class="text-green-400 text-xs font-semibold focus:outline-none"
                    type="submit"
                >
                    ADICIONAR
                </button>
            </form>

            <div
                v-if="todo.tasks.length"
                class="bg-gray-300 rounded-sm"
            >
                <TodoTaskCard
                    v-for="task in todo.tasks"
                    :key="task.id"
                    :task="task"
                    @afterDeleting="afterDeleting"
                />
            </div>

            <div
                v-else
                class="text-center text-lg text-gray-600"
            >
                Você ainda não tem nenhuma tarefa.
            </div>
        </template>
    </div>
</template>

<script>
    import TodoTaskCard from '../components/Todos/TodoTaskCard';
    export default {
        name: 'TodoTasks',

        data() {
            return {
                newTask: '',
                todo: {},
                spinner: {
                    get_todo: true,
                },
            };
        },

        components: {
            TodoTaskCard
        },

        created() {
            this.getTodo();
        },

        methods: {
            getTodo() {
                this.spinner.get_todo = true;
                this.$axios.get(`v1/todos/${this.$route.params.id}`).then((response) => {
                    this.todo = response.data.data;
                }).finally(() => {
                    this.spinner.get_todo = false;
                });
            },

            addTask() {
                if (!this.newTask) {
                    return;
                }

                const payload = {
                    label: this.newTask,
                };

                this.$axios.post(`v1/todos/${this.$route.params.id}/tasks`, payload).then((response) => {
                    this.todo.tasks.unshift(response.data.data);
                    this.newTask = '';
                });
            },

            afterDeleting(task) {
                const idx = this.todo.tasks.findIndex(o => o.id === task.id);
                this.todo.tasks.splice(idx, 1);
            },
        },


    };
</script>
