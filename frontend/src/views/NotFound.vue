<template>
  <div
    class="flex flex-col items-center justify-center h-screen text-center bg-gray-100"
  >
    <h1 class="text-6xl font-bold text-indigo-600 mb-4">404</h1>
    <p class="text-xl text-gray-600 mb-6">
      Oops! The page you're looking for doesn't exist.
    </p>
    <router-link
      to="/products"
      class="py-2 px-4 bg-indigo-600 text-white rounded hover:bg-indigo-700"
    >
      Back to Dashboard
    </router-link>
  </div>
</template>

<script>
export default {
  name: "NotFound",
};
</script>

<style scoped>
/* Add custom styles if needed */
</style>
