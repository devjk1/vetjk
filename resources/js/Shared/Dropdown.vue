<template>
    <div class="relative inline-block">
        <div @click="open = ! open" class="flex">
            <slot name="trigger"></slot>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false">
        </div>

        <transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95"
        >
            <div v-show="open"
                 class="absolute z-50 overflow-hidden mt-2 rounded-md shadow-lg"
                 :class="[widthClass, alignmentClasses]"
                 style="display: none;"
                 @click="open = false"
            >
                <div class="flex flex-col rounded-md bg-white">
                    <slot name="content"></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { defineComponent, onMounted, onUnmounted, ref } from "vue";

export default defineComponent({
    props: {
        align: {
            type: String,
            required: false,
            default: "right",
        },
        w: {
            type: String,
            required: false,
            default: "3",
        },
    },

    setup() {
        let open = ref(false)

        const closeOnEscape = (e) => {
            if (open.value && e.keyCode === 27) {
                open.value = false
            }
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

        return {
            open,
        }
    },

    computed: {
        widthClass() {
            const widths = {
                1: "w-32",
                2: "w-40",
                3: "w-48",
                4: "w-56",
                5: "w-64",
            };

            return widths[this.w];
        },

        alignmentClasses() {
            const alignments = {
                "left": "origin-top-left left-0",
                "right": "origin-top-right right-0",
                "top": "origin-top", 
            };

            return alignments[this.align];
        },
    }
})
</script>
