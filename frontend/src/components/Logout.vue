<template>
    <button @click="logout">Logout</button>
  </template>
  
  <script>
  export default {
    methods: {
      logout() {
        localStorage.removeItem('authToken'); // Clear token
        this.$router.push({ name: 'Login' }); // Redirect to Login
      },
    },
  };
  </script>
  