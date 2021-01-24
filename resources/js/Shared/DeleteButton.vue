<template>
  <div>
    <danger-button @click="showDeleteModal = true"><slot name="button" /></danger-button>

    <confirmation-modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #title>
        <slot name="title" />
      </template>

      <template #content>
        <slot name="message" />
      </template>

      <template #footer>
        <div class="flex justify-end">
          <secondary-button class="mr-4" @click="showDeleteModal = false">Nevermind</secondary-button>
          <danger-button @click="$emit('confirmed')">Delete</danger-button>
        </div>
      </template>
    </confirmation-modal>
  </div>
</template>

<script>
import DangerButton from "@/Jetstream/DangerButton";
import SecondaryButton from "@/Jetstream/SecondaryButton";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";

export default {
    components: {
        DangerButton,
        SecondaryButton,
        ConfirmationModal,
    },
    data() {
        return {
            showDeleteModal: false,
        }
    }
}
</script>

<style scoped>

</style>