<template>
  <button
    @click="logout"
    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"
  >
    Logout
  </button>
</template>

<script>
export default {
  methods: {
    logout() {
      localStorage.removeItem("authToken"); // Clear token
      this.$router.push({ name: "Login" }); // Redirect to Login
    },
  },
};
</script>
