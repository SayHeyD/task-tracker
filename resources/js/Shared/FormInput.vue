<template>
  <div class="w-full">
    <div class="flex w-full justify-between">
      <jet-label :id="id" v-text="label"></jet-label>
      <jet-input-error :message="errorMessage"></jet-input-error>
    </div>
    <jet-input :id="id" :class="inputClass" :type="type" :value="value" @input="$emit('input', $event)"></jet-input>
  </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

export default {
    components: {
        JetInput,
        JetInputError,
        JetLabel
    },
    props: ['id', 'value', 'label', 'errorMessage', 'type', 'inputClass']
}
</script>

<style scoped>

</style>