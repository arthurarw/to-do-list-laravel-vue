<template>
    <div class="flex items-center justify-between h-13 bg-gray-900 px-5">
        <div class="flex items-center">
            <svg
                class="h-6 w-6 text-blue-500"
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

            <span class="text-gray-500 ml-2">Todo list</span>
        </div>

        <div class="flex items-center">
            <TwDropdown
                naked
                no-padding
                class="text-gray-500"
            >
                <template v-slot:button-content>
                    <svg
                        class="h-6 w-6 mr-1"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M5.12104 17.8037C7.15267 16.6554 9.4998 16 12 16C14.5002 16 16.8473 16.6554 18.879 17.8037M15 10C15 11.6569 13.6569 13 12 13C10.3431 13 9 11.6569 9 10C9 8.34315 10.3431 7 12 7C13.6569 7 15 8.34315 15 10ZM21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                    {{ user.first_name }}
                </template>

                <TwDropdownItem :to="{ name: 'profile' }">
                    <svg
                        class="mr-3 h-5 w-5 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-500"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                    Meu perfil
                </TwDropdownItem>

                <TwDropdownItem :to="{ name: 'logout' }">
                    <svg
                        class="mr-3 h-5 w-5 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-500"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                    Logout
                </TwDropdownItem>
            </TwDropdown>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import TwDropdown from '@/components/Utils/TwDropdown';
import TwDropdownItem from '@/components/Utils/TwDropdownItem';

export default {
    name: 'TheHeader',

    components: {
        TwDropdown,
        TwDropdownItem,
    },

    data() {
        return {
        };
    },

    computed: {
        ...mapState({
            user: state => state.user.user,
        }),
    },

    methods: {},
};
</script>
