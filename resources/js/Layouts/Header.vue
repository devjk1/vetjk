<template>
    <header>
        <div class="flex items-center max-w-7xl mx-auto">
            <!-- LEFT -->
            <div class="flex w-1/3">
                <!-- LEFT Desktop -->
                <div class="hidden sm:block">
                    <Link :href="route('dashboard')">
                        Desktop
                    </Link>
                </div>
                <!-- LEFT Mobile -->
                <div class="sm:hidden">
                    <Link :href="route('dashboard')">
                        Mobile
                    </Link>
                </div>
            </div>
            <!-- MIDDLE -->
            <div class="flex w-1/3 justify-center">
                <!-- MIDDLE Desktop -->
                <div class="hidden sm:block">
                    <Link :href="route('dashboard')">
                        Desktop
                    </Link>
                </div>
                <!-- MIDDLE Mobile -->
                <div class="sm:hidden">
                    <Link :href="route('dashboard')">
                        Mobile
                    </Link>
                </div>
            </div>
            <!-- RIGHT -->
            <div class="flex w-1/3 justify-end">
                <!-- RIGHT Desktop -->
                <div class="hidden sm:block">
                    <Menu></Menu>
                </div>
                <!-- RIGHT Mobile -->
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="toggleMobileMenu()" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': openMobile, 'inline-flex': ! openMobile }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! openMobile, 'inline-flex': openMobile }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>        
    </header>
</template>

<script>
    import { defineComponent } from "vue";
    import { Link } from "@inertiajs/inertia-vue3";

    import Menu from "@/Layouts/Menu.vue";
    //
    import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

    export default defineComponent({
        components: {
            Link,
            Menu,
        },
        props: {
            openMobile: {
                type: Boolean,
                required: true,
            },
        },
        methods: {
            toggleMobileMenu() {
                this.$emit("toggle-mobile-menu");
            },
        },
    });
</script>