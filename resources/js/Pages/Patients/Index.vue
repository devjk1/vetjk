<template>
    <AppLayout title="Patient Index">
        <div class="flex justify-center p-4">
            <table class="table-auto w-full text-sm shadow-lg bg-gray-50">
                <thead class="bg-gray-800 text-white uppercase leading-normal">
                    <tr class="">
                        <th class="py-3 px-6 text-left">
                            Name
                        </th>
                        <th class="py-3 px-6 text-left">
                            Species
                        </th>
                        <th class="py-3 px-6 text-left">
                            Color
                        </th>
                        <th class="py-3 px-6 text-left">
                            DOB
                        </th>
                        <th class="py-3 px-6 text-center">
                            edit
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 font-light">
                    <template v-for="patient in patients.data" :key="patient.id">
                        <tr class="hover:bg-gray-200">
                            <td class="py-1 px-6 text-left">
                                {{ patient.name }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ patient.species }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ patient.color }}
                            </td>
                            <td class="py-1 px-6 text-left">
                                {{ patient.dob }}
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
        patients: {
            type: Object,
            required: true,
        },
    },
});
</script>