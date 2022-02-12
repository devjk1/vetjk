<template>
    <AppLayout title="User Show">
        <div class="flex flex-col space-y-4 mx-4 mt-4">
            <Link method="get"
                  :href="route('users.patients.create', owner.data.id)"
                  as="button"
                  class="btn w-64 px-4 py-2"
                  preserve-state
                  preserve-scroll
            >
                Add Patient to Owner
            </Link>
            <div class="rounded shadow p-4 bg-orange-100">
                <div class="font-bold text-xl">
                    {{ ownerName }}
                </div>
                <div class="">
                    {{ owner.data.email }}
                </div>
                <div class="">
                    {{ owner.data.phone }}
                </div>
                <Link method="get"
                    :href="route('users.edit', owner.data.id)"
                    as="button"
                    class="link2 w-24 px-4 py-2 mt-4"
                    preserve-state
                    preserve-scroll
                >
                    Edit
                </Link>
            </div>
        </div>
        <template v-for="patient in owner.data.patients" :key="patient.id">
            <div class="flex flex-col ml-16 mr-4 mt-4 p-4 shadow rounded bg-orange-50">
                <div class="font-semibold text-lg">
                    {{ patient.name }}        
                </div>
                <div class="">
                    {{ patient.species }}        
                </div>
                <div class="">
                    {{ patient.color }}        
                </div>
                <div class="">
                    {{ patient.dob }}        
                </div>
                <Link method="get"
                      :href="route('patients.edit', patient.id)"
                      as="button"
                      class="link2 w-24 px-4 py-2 mt-4"
                      preserve-state
                      preserve-scroll
                >
                    Edit
                </Link>
            </div>
        </template>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: {
        owner: {
            type: Object,
            required: true,
        },
    },
    computed: {
        ownerName() {
            return `${this.owner.data.first_name} ${this.owner.data.last_name}`;
        }
    },
});
</script>