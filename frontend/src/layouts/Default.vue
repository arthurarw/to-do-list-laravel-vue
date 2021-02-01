<template>
    <div>
        <TheHeader/>

        <div class="px-3 py-10 md:px-10">
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