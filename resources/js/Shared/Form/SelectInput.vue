<template>
  <div>
    <div class="flex w-full justify-between">
      <jet-label :for="id" v-text="label"></jet-label>
      <jet-input-error :message="errorMessage"></jet-input-error>
    </div>
    <select :name="name" :id="id" :value="value" class="w-full p-2 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus:outline-none rounded-md shadow-sm" @input="$emit('input', $event.target.value)" @change="$emit('change', $event.target.value)">
      <slot />
    </select>
  </div>
</template>

<script>
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    props: ['id', 'name', 'value', 'label', 'errorMessage'],
    components: {
        JetLabel,
        JetInputError,
    },
}
</script>