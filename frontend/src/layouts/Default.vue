<template>
    <div class="bg-gray-800">
        <TheHeader/>

        <div class="px-3 py-10 md:px-10 bg-gray-800">
            <RouterView/>
        </div>
    </div>
</template>

<script>
import TheHeader from '@/components/Partials/TheHeader';

export default {
    name: 'Default',

    components: {
        TheHeader,
    },

    data() {
        return {};
    },

    methods: {},
};
</script>