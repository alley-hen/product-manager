<template>
    <button
        type="button"
        class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 hover:shadow focus:bg-primary-dark active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <span class="flex justify-center items-center text-sm">
            <slot></slot>
        </span>
    </button>
</template>
<script>
    export default {
        props: {
            disabled: {
                type: Boolean,
                default: false
            },
        }
    }
</script>
