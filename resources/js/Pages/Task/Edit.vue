<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit {{ task.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg mb-4 p-4">
          <form-section @submitted="submit">
            <template #title>
              Edit {{ task.title }}
            </template>

            <template #description>
              Edit the task "{{ task.title }}". The updated values will be saved and your task feed will be updated.
            </template>

            <template #form>
              <form-input id="title" class="w-full col-span-6" input-class="w-full" label="Title" type="text" :error-message="errors.title" v-model="form.title"></form-input>
              <form-input id="description" class="w-full col-span-6" input-class="w-full" label="Description" type="text" :error-message="errors.description" v-model="form.description"></form-input>
              <select-input id="status" name="status" label="Status" class="w-full col-span-6" v-model="form.status">
                <option value="open" selected="selected">Open</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
              </select-input>
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
import JetButton from "@/Jetstream/Button";
import FormSection from "@/Jetstream/FormSection";
import FormInput from "@/Shared/Form/FormInput";
import SelectInput from "@/Shared/Form/SelectInput";

export default {
    props: {
        task: Object,
        errors: Object,
    },
    components: {
        AppLayout,
        JetButton,
        FormInput,
        FormSection,
        SelectInput
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
    mounted() {
        this.parseToForm()
    },
    methods: {
        parseToForm() {
            let form = this.form
            let task = this.task

            form.title = task.title
            form.description = task.description
            form.status = task.status
            form.due_at = task.due_at
        },
        submit() {
            if (!this.sending) {
                this.sending = true
                this.$inertia.patch(route('tasks.update', this.task.id), this.form, {
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