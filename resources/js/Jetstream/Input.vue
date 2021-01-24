<template>
    <input :id="id" :type="type" :placeholder="placeholder" class="p-2 border border-gray-300 focus:border-blue-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus:outline-none rounded-md shadow-sm" :value="value" @input="$emit('input', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['value', 'id', 'placeholder', 'type'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

