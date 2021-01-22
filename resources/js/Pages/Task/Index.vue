<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tasks
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-for="task in Tasks.data" class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4">
          <p v-text="task"></p>
        </div>
        <pagination :links="Tasks.links" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Shared/Pagination";

export default {
    props: {
        Tasks: Object,
    },
    components: {
        AppLayout,
        Pagination,
    }
}
</script>

<style scoped>

</style>