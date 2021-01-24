<template>
  <div class="flex items-center">
    <jet-input class="w-full" autocomplete="off" type="text" name="search" placeholder="Search for a title…" :value="value" @input="$emit('input', $event)" />

    <jet-secondary-button class="ml-2" @click="$emit('reset')">Reset</jet-secondary-button>
  </div>
</template>

<script>
import JetInput from "@/Jetstream/Input";
import JetSecondaryButton from "@/Jetstream/SecondaryButton"

export default {
    components: {
        JetInput,
        JetSecondaryButton
    },
    props: {
        value: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
}
</script>