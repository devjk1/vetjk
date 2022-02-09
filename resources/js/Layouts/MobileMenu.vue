<template>
    <div :class="{ 'block': openMobile, 'hidden': ! openMobile }">
        <div class="flex flex-col">
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3">
                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
            </div>
            <div class="px-4 py-4">
                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
            </div>
            <Link :href="route('dashboard')"
                  :class="[ route().current('dashboard') ? 'active' : 'inactive' ]"
                  class="link-dropdown block p-6"
            >
                Dashboard
            </Link>
            <Link :href="route('profile.show')"
                  :class="[ route().current('profile.show') ? 'active' : 'inactive' ]"
                  class="link-dropdown block p-6"
            >
                Profile
            </Link>
            <Link method="post"
                  :href="route('logout')"
                  as="button"
                  class="link-dropdown block p-6 text-left"
            >
                Log Out
            </Link>
            <Link :href="route('api-tokens.index')"
                  :class="[ route().current('api-tokens.index') ? 'active' : 'inactive' ]"
                  class="link-dropdown block p-6"
                  v-if="$page.props.jetstream.hasApiFeatures"
            >
                API Tokens
            </Link>

            <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-100"></div>
                <div class="label-dropdown px-6 py-2">
                    Manage Team
                </div>
                <!-- Team Settings -->
                <Link :href="route('teams.show', $page.props.user.current_team)"
                      :class="[ route().current('teams.show') ? 'active' : 'inactive' ]"
                      class="link-dropdown p-6"
                >
                    Team Settings
                </Link>
                <Link :href="route('teams.create')"
                      :class="[ route().current('teams.create') ? 'active' : 'inactive' ]"
                      class="link-dropdown p-6"
                      v-if="$page.props.jetstream.canCreateTeams"
                >
                    Create New Team
                </Link>

                <div class="border-t border-gray-100"></div>
                <!-- Team Switcher -->
                <div class="label-dropdown px-6 py-2">
                    Switch Teams
                </div>
                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                    <Link method="put"
                          :href="route('current-team.update', { team_id: team.id }, { preserveState: false })"
                          as="button"
                          :class="[ route().current('current-team.update') ? 'active' : 'inactive' ]"
                          class="link-dropdown flex items-center p-6"
                          preserve-scroll
                    >
                        <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>{{ team.name }}</div>
                    </Link>
                </template>
            </template>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: {
        openMobile: {
            type: Boolean,
            required: true,
        },
    },
    setup() {

    },
    data() {
        return {

        };
    },
    // methods: {
    //     switchToTeam(team) {
    //         this.$inertia.put(route('current-team.update'), {
    //             'team_id': team.id
    //         }, {
    //             preserveState: false
    //         })
    //     },
    //     logout() {
    //         this.$inertia.post(route('logout'));
    //     },
    // }
});
</script>