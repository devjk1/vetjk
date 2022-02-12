<template>
    <AppLayout title="Users Index">
        <div class="flex flex-col p-4 space-y-4">
            <Link method="get"
                  :href="route('users.create')"
                  as="button"
                  class="btn w-48 px-4 py-2"
                  preserve-state
                  preserve-scroll
            >
                Create Owner
            </Link>
            <table class="table-auto w-full text-sm shadow-lg bg-gray-50">
                <thead class="bg-gray-800 text-white uppercase leading-normal">
                    <tr class="">
                        <th class="py-3 px-6 text-left">
                            First Name
                        </th>
                        <th class="py-3 px-6 text-left">
                            Last Name
                        </th>
                        <th class="py-3 px-6 text-left">
                            Role
                        </th>
                        <th class="py-3 px-6 text-left">
                            Phone
                        </th>
                        <th class="py-3 px-6 text-left">
                            Email
                        </th>
                        <th class="py-3 px-6 text-center">
                            edit
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 font-light">
                    <template v-for="user in users.data" :key="user.id">
                        <tr class="hover:bg-gray-200">
                            <td class="py-1 px-6 text-left">
                                {{ user.first_name }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ user.last_name }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ user.role }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ user.phone }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ user.email }}
                            </td>
                            <td class="flex items-center justify-center text-center">
                                <Link :href="route('users.show', user.id)" class="link2 px-4 py-2">
                                    View
                                </Link>
                                <Link :href="route('users.edit', user.id)" class="link2 px-4 py-2">
                                    Edit
                                </Link>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <Pagination :links="users.links" />
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Pagination.vue";

export default defineComponent({
    components: {
        AppLayout,
        Link,
        Pagination,
    },
    props: {
        users: {
            type: Object,
            required: true,
        },
    },
});
</script>