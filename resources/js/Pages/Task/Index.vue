<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tasks
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <task-card :key="task.id" v-for="task in Tasks.data" :task="task" @updated="refreshTasks" />
        <pagination :links="Tasks.links" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Shared/Pagination";
import TaskCard from "@/Shared/Task/Card";

export default {
    props: {
        Tasks: Object,
    },
    components: {
        AppLayout,
        TaskCard,
        Pagination,
    },
    methods: {
        refreshTasks() {
            Inertia.reload({ only: ['Tasks'] })
        }
    }
}
</script>

<style scoped>

</style>