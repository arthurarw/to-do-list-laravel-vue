<template>
    <div class="flex items-center justify-between bg-gray-300 rounded-sm px-4 h-16 mb-2">
        <div class="text-gray-700 font-light truncate">
            {{ todo.label }}<br>
        </div>

        <div class="flex items-center justify-center">
            <TwDropdown
                naked
                no-icon
                no-padding
            >
                <template v-slot:button-content>
                    <span class="text-gray-500 hover:text-gray-600">
                        <svg
                            class="h-5 w-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                            />
                        </svg>
                    </span>
                </template>

                <TwDropdownItem @click="onUpdate()">
                    <svg
                        class="mr-3 h-5 w-5 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-500"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9L9 12.1716L17.5858 3.58579Z"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    Editar
                </TwDropdownItem>

                <TwDropdownItem @click="onDelete()">
                    <div class="flex items-center text-red-700 hover:text-red-800">
                        <svg
                            class="mr-3 h-5 w-5"
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
                        Excluir
                    </div>
                </TwDropdownItem>
            </TwDropdown>
        </div>
    </div>
</template>

<script>
    import TwDropdown from '@/components/Utils/TwDropdown';
    import TwDropdownItem from '@/components/Utils/TwDropdownItem';

    export default {
        name: 'TodoCardShow',

        components: {
            TwDropdown,
            TwDropdownItem,
        },

        props: {
            todo: {
                type: Object,
                default: () => ({}),
            },
        },

        data() {
            return {};
        },

        methods: {
            onUpdate() {
                this.$emit('update');
            },

            onDelete() {
                this.$emit('delete');
            },
        },
    };
</script>

<style scoped>

</style>
