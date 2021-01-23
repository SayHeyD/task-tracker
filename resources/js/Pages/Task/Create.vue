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
              <form-input id="complete" label="Complete" type="checkbox" :error-message="errors.checkbox" v-model="form.checkbox"></form-input>
              <form-input id="due_at" class="w-full col-span-6" input-class="w-full" label="Due at" type="text" :error-message="errors.due_at" v-model="form.due_at"></form-input>
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
import FormInput from "@/Shared/FormInput";
import JetButton from "@/Jetstream/Button"

export default {
    components: {
        AppLayout,
        FormSection,
        FormInput,
        JetButton,
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
                complete: null,
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