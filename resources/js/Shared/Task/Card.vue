<template>
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4 p-4 pb-0">
    <div>
      <div class="flex">
        <div class="flex items-center">
          <button class="cursor-pointer focus:outline-none" @click="toggleCompletionStatus">
            <svg v-if="task.status === 'completed'" focusable="false" data-prefix="fas" data-icon="check-circle" class="h-12 w-12 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
            <svg v-else-if="task.status === 'failed'" focusable="false" data-prefix="fas" data-icon="times-circle" class="h-12 w-12 text-red-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path></svg>
            <svg v-else class="h-12 w-12 text-gray-300" width="512" height="512" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119 8 8 119 8 256C8 393 119 504 256 504C393 504 504 393 504 256C504 119 393 8 256 8Z" fill="currentColor"/><path d="M173.9 377.6C178.6 382.3 186.2 382.3 190.9 377.6L377.7 191C382.4 186.3 382.4 178.7 377.7 174L338.1 134.4C333.4 129.7 325.8 129.7 321.1 134.4L134.4 321C129.7 325.7 129.7 333.3 134.4 338L173.9 377.6Z" fill="white"/></svg>
          </button>
        </div>
        <div class="ml-2 p-2 flex-1">
          <p class="text-xl flex justify-between mb-2">
            <span v-text="task.title"></span>
            <span v-if="task.due_at" class="text-gray-500 text-sm inline-flex items-start">Due at: {{ task.due_at }}</span>
            <span v-else class="text-gray-500 text-sm inline-flex items-start">No due date</span>
          </p>
          <p class="text-sm text-gray-500" v-text="task.description"></p>
        </div>
      </div>
    </div>

    <div v-if="!collapsed">
      <p>Lorem ipsum</p>
      <danger-button @click="showDeleteModal = true">Delete</danger-button>
    </div>

    <div>
      <button class="w-full flex justify-center mb-2 cursor-pointer" @click="toggleCard">
        <svg v-if="collapsed" focusable="false" data-prefix="fas" data-icon="chevron-down" class="h-4 w-8 text-gray-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path></svg>
        <svg v-else focusable="false" data-prefix="fas" data-icon="chevron-up" class="h-4 w-8 text-gray-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path></svg>
      </button>
    </div>

    <confirmation-modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #title>
        Confirm Action
      </template>

      <template #content>
        Are you sure you want to delete the task "{{ task.title }}"?
      </template>

      <template #footer>
        <div class="flex justify-end">
          <secondary-button class="mr-4" @click="showDeleteModal = false">Nevermind</secondary-button>
          <danger-button @click="deleteTask">Delete</danger-button>
        </div>
      </template>
    </confirmation-modal>
  </div>
</template>

<script>
import DangerButton from "@/Jetstream/DangerButton";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import SecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    props: {
        task: Object,
    },
    components: {
        DangerButton,
        ConfirmationModal,
        SecondaryButton,
    },
    data() {
        return {
            collapsed: true,
            isUpdatingStatus: false,
            showDeleteModal: false,
        }
    },
    methods: {
        toggleCompletionStatus() {
            if (!this.isUpdatingStatus) {
                this.isUpdatingStatus = true

                let newStatus

                if (this.task.status === 'open') {
                    newStatus = 'completed'
                } else if (this.task.status === 'completed') {
                    newStatus = 'failed'
                } else {
                    newStatus = 'open'
                }

                this.$inertia.patch(route('tasks.update', this.task.id), {
                    status: newStatus,
                }, {
                    onFinish: () => {
                        this.isUpdatingStatus = false
                        this.$emit('updated')
                    }
                })
            }
        },
        deleteTask() {
            this.$inertia.delete(route('tasks.delete', this.task.id), {
                onFinish: () => {
                    this.showDeleteModal = false
                }
            })
        },
        toggleCard() {
            this.collapsed = !this.collapsed;
        }
    }
}
</script>

<style scoped>

</style>