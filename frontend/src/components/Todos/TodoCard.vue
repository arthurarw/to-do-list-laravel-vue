<template>
    <div>
        <TodoCardShow
            v-if="isShowing"
            :todo="todo"
            @update="changeStateToUpdate"
            @delete="changeStateToDelete"
        />

        <TodoCardUpdate
            v-if="isUpdating"
            :todo="todo"
            @cancel="changeStateToShow"
        />

        <TodoCardDelete
            v-if="isDeleting"
            :todo="todo"
            @cancel="changeStateToShow"
            @afterDeleting="afterDeleting"
        />
    </div>
</template>

<script>
    import TodoCardShow from './TodoCardShow';
    import TodoCardUpdate from './TodoCardUpdate';
    import TodoCardDelete from './TodoCardDelete';

    export default {
        name: 'TodoCard',

        components: {
            TodoCardDelete,
            TodoCardUpdate,
            TodoCardShow,
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

        computed: {
            isShowing() {
                return this.todo.state === 'show';
            },

            isUpdating() {
                return this.todo.state === 'update';
            },

            isDeleting() {
                return this.todo.state === 'delete';
            },
        },

        methods: {
            changeStateToShow() {
                this.todo.state = 'show';
            },

            changeStateToUpdate() {
                this.todo.state = 'update';
            },

            changeStateToDelete() {
                this.todo.state = 'delete';
            },

            afterDeleting(todo) {
                this.$emit('afterDeleting', todo);
            },
        },


    };
</script>

<style scoped>

</style>
