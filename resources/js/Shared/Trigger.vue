<template>
    <div class="flex-shrink-0 inline-flex items-center justify-center space-x-1 rounded-md"
         :class="paddingClasses"
    >
        <div>
            <slot></slot>
        </div>
        <slot name="img"></slot>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    components: {

    },
    props: {
        p: {
            type: String,
            required: false,
            default: "px-3 py-2",
        },
    },
    setup() {

    },
    data() {
        return {
            
        };
    },
    computed: {
        paddingClasses() {
            return this.p;
        },
    },
});
</script>