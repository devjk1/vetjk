<template>
    <AppLayout title="User Create">
        <form @submit.prevent="form.post(route('users.store'), options)" class="form flex flex-col max-w-7xl space-y-6 mx-auto mt-4 p-4">
            <div class="">
                <label for="first_name" class="label-input">
                    First Name
                </label>
                <input type="text"
                       id="first_name"
                       class="input px-3 py-2"
                       v-model="form.first_name"
                />
                <div class="error-input" v-if="form.errors.first_name">
                    {{ form.errors.first_name }}
                </div>
            </div>
            <div class="">
                <label for="last_name" class="label-input">
                    Last Name
                </label>
                <input type="text"
                       id="last_name"
                       class="input px-3 py-2"
                       v-model="form.last_name"
                />
                <div class="error-input" v-if="form.errors.last_name">
                    {{ form.errors.last_name }}
                </div>
            </div>
            <div class="">
                <label for="email" class="label-input">
                    Email
                </label>
                <input type="text"
                       id="email"
                       class="input px-3 py-2"
                       v-model="form.email"
                />
                <div class="error-input" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="">
                <label for="phone" class="label-input">
                    Phone
                </label>
                <input type="tel"
                       id="phone"
                       class="input px-3 py-2"
                       v-model="form.phone"
                />
                <div class="error-input" v-if="form.errors.phone">
                    {{ form.errors.phone }}
                </div>
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="btn px-4 py-2" :disabled="form.processing">
                    Create Owner
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

    },
    setup() {
        const form = useForm({
            first_name: "",
            last_name: "",
            email: "",
            phone: "",
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