<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Tasks
        </h2>
        <jet-button @click="$inertia.visit(route('tasks.create'))">New task</jet-button>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <search-filter class="mb-4" v-model="form.search" @reset="reset" />
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
import JetButton from "@/Jetstream/Button";
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'

export default {
    props: {
        Tasks: Object,
        Filters: Object,
    },
    components: {
        AppLayout,
        TaskCard,
        Pagination,
        Toaster,
        JetButton,
        SearchFilter,
    },
    data() {
        return {
            form: {
                search: this.Filters.search,
            },
        }
    },
    mounted() {
        if (this.$page.props.flash.success) {
            this.$toast.success(this.$page.props.flash.success)
        }
    },
    watch: {
        form: {
            handler: throttle(function() {
                let query = pickBy(this.form)
                this.$inertia.get(this.route('tasks.index', query), {}, {
                    replace: true,
                    preserveState: true,
                    preserveScroll: true,
                })
            }, 150),
            deep: true,
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
}
</script>

<style scoped>

</style>