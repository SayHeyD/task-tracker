<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tasks
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <task-card :key="task.id" v-for="task in Tasks.data" :task="task" />
        <pagination :links="Tasks.links" />
      </div>
    </div>

    <toaster :flash="this.$page.props.flash"
             :errors="this.$page.props.errors"
             :success-delay="2500"/>

  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Shared/Pagination";
import TaskCard from "@/Shared/Task/Card";
import Toaster from "@/Shared/Toaster";

export default {
    props: {
        Tasks: Object,
    },
    components: {
        AppLayout,
        TaskCard,
        Pagination,
        Toaster,
    },
}
</script>

<style scoped>

</style>