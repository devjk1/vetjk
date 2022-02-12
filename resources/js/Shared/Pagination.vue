<template>
    <div class="flex items-center justify-center space-x-12 text-gray-400 text-sm">
        <div class="flex space-x-24">
            <Link method="get"
                :href="links.first"
                as="button"
                class="flex items-center space-x-2"
                preserve-state
                preserve-scroll
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <div class="font-extrabold tracking-widest">
                    First
                </div>
            </Link>
            <Link method="get"
                :href="links.prev"
                as="button"
                class="flex items-center space-x-2"
                preserve-state
                preserve-scroll
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 19l-7-7 7-7" />
                </svg>
                <div class="font-extrabold tracking-widest">
                    Prev
                </div>
            </Link>
        </div>
        <div class="flex space-x-24">
            <Link method="get"
                :href="links.next"
                as="button"
                class="flex items-center space-x-2"
                preserve-state
                preserve-scroll
            >
                <div class="font-extrabold tracking-widest">
                    Next
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
                </svg>
            </Link>
            <Link method="get"
                :href="links.last"
                as="button"
                class="flex items-center space-x-2"
                preserve-state
                preserve-scroll
            >
                <div class="font-extrabold tracking-widest">
                    Last
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </Link>
        </div>
    </div>
</template>
  
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        links: {
            type: Object,
            required: true,
        },
    },
}
</script>