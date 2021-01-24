<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        New Task
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg mb-4 p-4">
          <form-section @submitted="submit">
            <template #title>
              Create a new Task
            </template>

            <template #description>
              Create a new Task with subtasks. This task will be shown in your task list.
            </template>

            <template #form>
              <form-input id="title" class="w-full col-span-6" input-class="w-full" label="Title" type="text" :error-message="errors.title" v-model="form.title"></form-input>
              <form-input id="description" class="w-full col-span-6" input-class="w-full" label="Description" type="text" :error-message="errors.description" v-model="form.description"></form-input>
              <jet-label>Status</jet-label>
              <div class="w-full col-span-6 flex justify-around">
                <button type="button" class="focus:outline-none" @click="form.status = 'completed'">
                  <svg :class="[form.status === 'completed' ? 'text-green-500 scale-110' : 'text-gray-300']" class="w-12 h-12 transition transform duration-250" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                </button>
                <button type="button" class="focus:outline-none" @click="form.status = 'failed'">
                  <svg :class="[form.status === 'failed' ? 'text-red-500 scale-110' : 'text-gray-300']" class="w-12 h-12 transition transform duration-250" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path></svg>
                </button>
                <button type="button" class="focus:outline-none" @click="form.status = 'open'">
                  <svg :class="[form.status === 'open' ? 'text-gray-500 scale-110' : 'text-gray-300']" class="w-12 h-12 transition transform duration-250" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M256 8C119 8 8 119 8 256C8 393 119 504 256 504C393 504 504 393 504 256C504 119 393 8 256 8Z"/><path fill="white" d="M173.9 377.6C178.6 382.3 186.2 382.3 190.9 377.6L377.7 191C382.4 186.3 382.4 178.7 377.7 174L338.1 134.4C333.4 129.7 325.8 129.7 321.1 134.4L134.4 321C129.7 325.7 129.7 333.3 134.4 338L173.9 377.6Z"/></svg>
                </button>
              </div>
              <date-time-input id="due_at" label="Due at" name="due_at" :error-message="errors.due_at" class="w-full col-span-6" :submitting="sending" v-model="form.due_at"></date-time-input>
            </template>

            <template #actions>
              <jet-button type="submit" :disabled="sending">
                <span v-if="sending">sending ...</span>
                <span v-else>submit</span>
              </jet-button>
            </template>
          </form-section>
        </div>
      </div>
    </div>

  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import FormSection from "@/Jetstream/FormSection";
import FormInput from "@/Shared/Form/FormInput";
import SelectInput from "@/Shared/Form/SelectInput";
import DateTimeInput from "@/Shared/Form/DateTimeInput";
import JetLabel from "@/Jetstream/Label"
import JetButton from "@/Jetstream/Button"

export default {
    components: {
        AppLayout,
        FormSection,
        FormInput,
        JetButton,
        SelectInput,
        DateTimeInput,
        JetLabel,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            sending: false,
            form: {
                title: null,
                description: null,
                status: null,
                due_at: null,
            }
        }
    },
    methods: {
        submit() {
            if (!this.sending) {
                this.sending = true
                this.$inertia.put(route('tasks.store'), this.form, {
                    onFinish: () => {
                        this.sending = false
                    }
                })
            }
        }
    }
}
</script>

<style scoped>

</style>