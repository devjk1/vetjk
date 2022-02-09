<template>
    <div class="flex items-center space-x-4">
        <!-- unused dropdown - vetjk app does not use teams -->
        <!-- LEFT Dropdown (TEAM) -->
        <Dropdown align="right" v-if="$page.props.jetstream.hasTeamFeatures">
            <template #trigger>
                <Trigger class="cursor-default">
                    {{ $page.props.user.current_team.name }}
                    <template #img>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </template>
                </Trigger>
            </template>
            <template #content>
                <!-- Team Management -->
                <template v-if="$page.props.jetstream.hasTeamFeatures">
                    <div class="label-dropdown px-4 py-2">
                        Manage Team
                    </div>
                    <Link :href="route('teams.show', $page.props.user.current_team)"
                          :class="[ route().current('teams.show') ? 'active' : 'inactive' ]"
                          class="link-dropdown block px-4 py-2"
                    >
                        Team Settings
                    </Link>
                    <Link :href="route('teams.create')"
                          :class="[ route().current('teams.create') ? 'active' : 'inactive' ]"
                          class="link-dropdown block px-4 py-2"
                    >
                        Create New Team
                    </Link>
                    <div class="border-t border-gray-100"></div>

                    <div class="label-dropdown px-4 py-2">
                        Switch Teams
                    </div>
                    <template v-for="team in $page.props.user.all_teams" :key="team.id">
                        <Link method="put"
                              :href="route('current-team.update', { team_id: team.id }, { preserveState: false })"
                              as="button"
                              class="link-dropdown flex items-center px-4 py-2"
                        >
                            <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>{{ team.name }}</div>
                        </Link>
                    </template>
                </template>
            </template>
        </Dropdown>
        <Dropdown align="right" w="1">
            <template #trigger>
                <Trigger class="cursor-default">
                    {{ $page.props.user.first_name }} {{ $page.props.user.last_name }}
                    <template #img>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </template>
                </Trigger>
            </template>
            <template #content>
                <div class="label-dropdown px-4 py-2">
                    Manage Account
                </div>
                <Link :href="route('profile.show')"
                      :class="[ route().current('profile.show') ? 'active' : 'inactive' ]"
                      class="link-dropdown block px-4 py-2"
                >
                    Profile
                </Link>
                <Link :href="route('api-tokens.index')"
                      :class="[ route().current('api-tokens.index') ? 'active' : 'inactive' ]"
                      class="link-dropdown block px-4 py-2"
                      v-if="$page.props.jetstream.hasApiFeatures"
                >
                    API Tokens
                </Link>

                <div class="border-t border-gray-100"></div>

                <Link method="post"
                      :href="route('logout')"
                      as="button"
                      class="link-dropdown block px-4 py-2 text-left"
                >
                    Log Out
                </Link>
            </template>
        </Dropdown>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";

import Dropdown from "@/Shared/Dropdown.vue";
import Trigger from "@/Shared/Trigger.vue";

export default defineComponent({
    components: {
        Dropdown,
        Trigger,
        Link,
    },
});
</script>