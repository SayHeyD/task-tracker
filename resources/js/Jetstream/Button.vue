<template>
    <button :disabled="disabled" :type="type" :class="{'cursor-not-allowed': disabled}" class="inline-flex disabled:opacity-40 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            disabled: {
                type: Boolean,
                default: false,
            },
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
