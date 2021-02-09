<template>
    <Component
        :is="is"
        :href="localHref"
        :to="to"
        class="w-full h-full focus:outline-none"
    >
        <span
            :class="classList"
            @click="onClick"
        >
            <slot />
        </span>
    </Component>
</template>

<script>
    export default {
        name: 'TwDropdownItem',

        inject: ['TwDropdown'],

        props: {
            href: {
                type: String,
                default: undefined,
            },

            disabled: {
                type: Boolean,
                default: false,
            },

            to: {
                type: [String, Object],
                default: undefined,
            },
        },

        computed: {
            classList() {
                return [
                    'group flex items-center',
                    'block w-full px-4 py-2 text-sm leading-5 hover:bg-gray-100',
                    'focus:outline-none focus:bg-gray-100',
                    this.getTextColorClass,
                ];
            },

            getTextColorClass() {
                return this.disabled ? 'text-gray-300 hover:text-gray-300 focus:text-gray-900' : 'text-gray-700 hover:text-gray-900 focus:text-gray-900';
            },

            localHref() {
                if (typeof this.to !== 'undefined' || this.disabled) {
                    return undefined;
                }

                return this.href;
            },

            is() {
                if (typeof this.to !== 'undefined') {
                    return 'RouterLink';
                }

                if (typeof this.href !== 'undefined') {
                    return 'a';
                }

                return 'button';
            },
        },

        methods: {
            onClick(evt) {
                if (this.disabled) {
                    return false;
                }

                this.$emit('click', evt);
                this.closeDropdown();
            },

            closeDropdown() {
                this.TwDropdown.close();
            },
        },
    };
</script>
