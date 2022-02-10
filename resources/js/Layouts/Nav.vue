<template>
    <nav class="flex items-center justify-center space-x-4">
        <Link :href="route('users.index')">Users.Index</Link>
        <Link :href="route('patients.index')">Patients.Index</Link>
    </nav>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: {

    },
    setup() {

    },
    data() {
        return {
            
        };
    },
});
</script>