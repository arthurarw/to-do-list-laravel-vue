<template>
    <div class="flex items-center px-4 py-3 border-b border-gray-400 last:border-b-0">
        <div
            class="cursor-pointer mr-2"
            @click.stop.prevent="task.is_complete = !task.is_complete"
        >
            <svg
                v-if="task.is_complete"
                class="h-5 w-5 text-green-600"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM13.7071 8.70711C14.0976 8.31658 14.0976 7.68342 13.7071 7.29289C13.3166 6.90237 12.6834 6.90237 12.2929 7.29289L9 10.5858L7.70711 9.29289C7.31658 8.90237 6.68342 8.90237 6.29289 9.29289C5.90237 9.68342 5.90237 10.3166 6.29289 10.7071L8.29289 12.7071C8.68342 13.0976 9.31658 13.0976 9.70711 12.7071L13.7071 8.70711Z"
                    fill="currentColor"
                />
            </svg>

            <div
                v-else
                class="h-5 w-5 flex items-center justify-center"
            >
                <div class="h-4 w-4 rounded-full border-2 border-gray-400"/>
            </div>
        </div>

        <div class="w-full">
            <input
                v-model="task.label"
                ref="input"
                type="text"
                placeholder="Digite a sua tarefa"
                class="bg-gray-300 placeholder-gray-500 text-gray-700 font-light focus:outline-none block w-full appearance-none leading-normal mr-3"
                @input="handleInput"
            >
        </div>

        <div class="ml-auto flex items-center justify-center">
            <button
                class="focus:outline-none"
                @click.stop.prevent="deleteTask()"
            >
                <svg
                    class="ml-3 h-4 w-4 text-gray-500"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19 7L18.1327 19.1425C18.0579 20.1891 17.187 21 16.1378 21H7.86224C6.81296 21 5.94208 20.1891 5.86732 19.1425L5 7M10 11V17M14 11V17M15 7V4C15 3.44772 14.5523 3 14 3H10C9.44772 3 9 3.44772 9 4V7M4 7H20"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
    import {debounce} from 'lodash';

    export default {
        name: 'TodoTaskCard',

        props: {
            task: {
                type: Object,
                default: () => ({}),
            },
        },

        data() {
            return {};
        },

        watch: {
            'task.is_complete'() {
                this.updateTask();
            },
        },

        methods: {
            deleteTask() {
                this.$axios.delete(`v1/todo-tasks/${this.task.id}`).then(() => {
                    this.$emit('afterDeleting', this.task);
                });
            },

            updateTask() {
                const payload = {
                    label: this.task.label,
                    is_complete: this.task.is_complete,
                };

                this.$axios.put(`v1/todo-tasks/${this.task.id}`, payload);
            },

            handleInput: debounce(function() {
                this.updateTask();
            }, 500),
        },
    };
</script>
