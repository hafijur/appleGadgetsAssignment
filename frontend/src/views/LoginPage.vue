<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
      <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <p class="text-sm text-gray-500 text-center mb-6">Please sign in to your account</p>
        <form @submit.prevent="handleSubmit">
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input
              v-model="email"
              type="email"
              id="email"
              placeholder="Enter your email"
              class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
              required
            />
          </div>
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input
              v-model="password"
              type="password"
              id="password"
              placeholder="Enter your password"
              class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
              required
            />
          </div>
          <button
            type="submit"
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition"
          >
            Sign In
          </button>
        </form>

      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "LoginPage",
    data() {
      return {
        email: "admin@admin.com",
        password: "12345678",
      };
    },
    methods: {
      handleSubmit() {

        // Send a POST request to the API
        const baseUrl = import.meta.env.VITE_API_BASE_URL;
        fetch(`${baseUrl}/login`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: this.email,
            password: this.password,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            console.log('data is ',data.token);
            // Store the token in the local storage
            localStorage.setItem("authToken", data.token);
            // Redirect to the home page
            this.$router.push({ name: "ProductView" });
          })
          .catch((error) => {
            // this.showError("Invalid email or password");
          });
      },
    },
  };
  </script>
  