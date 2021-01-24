<template>
  <div class="mt-6 -mb-1 flex flex-wrap">
    <template v-for="(link, key) in links">
      <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border bg-white rounded text-gray-400" :class="{ 'ml-auto': link.label === 'Next', 'cursor-not-allowed': link.url === null }">{{ link.label }}</div>
      <inertia-link v-else :key="key"
                    class="mr-1 mb-1 px-4 py-3 text-sm border rounded bg-white hover:border-blue-500 focus:border-blue-500 focus:text-blue-500"
                    :class="{ 'bg-white cursor-not-allowed border-blue-500 text-blue-500': link.active || link.url === null, 'ml-auto': link.label === 'Next'}"
                    :href="link.url">{{ link.label }}</inertia-link>
    </template>
  </div>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>