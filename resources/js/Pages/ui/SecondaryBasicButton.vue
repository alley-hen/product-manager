<template>
    <div class="bg-secondary font-semibold text-white px-4 py-2 rounded-md hover:shadow-neutral-400 hover:bg-secondary-light flex justify-center items-center">
        <Link class="uppercase flex justify-center items-center" :href="href">
            <span class="flex justify-center items-center text-sm">
                <slot></slot>
            </span>
        </Link>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
export default {
    components: {
        Link
    },
    props: {
        href: {
            type: String,
            required: true,
        },
        disabled: {
            type: Boolean,
            default: false
        },
    },
}
</script>
