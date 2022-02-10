<template>
    <AppLayout title="Users Index">
        <div class="flex justify-center p-4">
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
                                placeholder
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
    components: {
        AppLayout,
    },
    props: {
        users: {
            type: Object,
            required: true,
        },
    },
});
</script>