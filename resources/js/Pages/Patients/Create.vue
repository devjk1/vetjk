<template>
    <AppLayout title="Patient Create">
        <form @submit.prevent="form.post(route('users.patients.store', owner.data.id), options)" class="form flex flex-col max-w-7xl space-y-6 mx-auto mt-4 p-4">
            <div class="">
                <label for="name" class="label-input">
                    Name
                </label>
                <input type="text"
                       id="name"
                       class="input px-3 py-2"
                       v-model="form.name"
                />
                <div class="error-input" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="">
                <label for="species" class="label-input">
                    Species
                </label>
                <input type="text"
                       id="species"
                       class="input px-3 py-2"
                       v-model="form.species"
                />
                <div class="error-input" v-if="form.errors.species">
                    {{ form.errors.species }}
                </div>
            </div>
            <div class="">
                <label for="color" class="label-input">
                    Color
                </label>
                <input type="text"
                       id="color"
                       class="input px-3 py-2"
                       v-model="form.color"
                />
                <div class="error-input" v-if="form.errors.color">
                    {{ form.errors.color }}
                </div>
            </div>
            <div class="">
                <label for="dob" class="label-input">
                    Date of Birth
                </label>
                <input type="date"
                       id="dob"
                       class="input px-3 py-2"
                       v-model="form.dob"
                />
                <div class="error-input" v-if="form.errors.dob">
                    {{ form.errors.dob }}
                </div>
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="btn px-4 py-2" :disabled="form.processing">
                    Add Patient to Owner
                </button>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        AppLayout,
    },
    props: {
        owner: {
            type: Object,
            required: true,
        }
    },
    setup() {
        const form = useForm({
            name: "",
            species: "",
            color: "",
            dob: "",
        });
        
        const options = {
            preserveScroll: true,
            preserveState: (page) => Object.keys(page.props.errors).length,
        };
        
        return { form, options };
    },
    data() {
        return {

        };
    },
});
</script>