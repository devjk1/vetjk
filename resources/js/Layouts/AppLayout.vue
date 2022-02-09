<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="flex flex-col min-h-screen bg-gray-100 text-gray-700">
            <Header @toggle-mobile-menu="toggleMobileMenu()" :open-mobile="openMobile" class="bg-gray-700 text-white px-6 md:px-16 py-6"></Header>
            <Nav class="bg-gray-500 text-white px-6 md:px-16 py-1"></Nav>
            <MobileMenu :open-mobile="openMobile" class="sm:hidden bg-white text-gray-700 shadow-md"></MobileMenu>
            <main class="flex-1">
                <slot></slot>
            </main>
            <Footer class="bg-gray-700 text-white px-6 md:px-16 py-6"></Footer>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from "vue";
    import { Head, Link } from "@inertiajs/inertia-vue3";

    import Header from "@/Layouts/Header.vue";
    import Nav from "@/Layouts/Nav.vue";
    import Footer from "@/Layouts/Footer.vue";
    import MobileMenu from "@/Layouts/MobileMenu.vue";

    import JetBanner from "@/Jetstream/Banner.vue";

    export default defineComponent({
        props: {
            title: String,
        },
        components: {
            Head,
            Link,
            Header,
            Nav,
            Footer,
            MobileMenu,
            JetBanner,
        },
        data() {
            return {
                openMobile: false,
            };
        },
        methods: {
            toggleMobileMenu() {
                this.openMobile = !this.openMobile;
            }
        }
    })
</script>
