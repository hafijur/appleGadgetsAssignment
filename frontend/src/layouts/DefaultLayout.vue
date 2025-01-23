<template>
  <div class="flex h-screen">
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
      <div class="p-6">
        <h2 class="text-2xl font-bold">
          <router-link to="/products" class="text-white"> My App </router-link>
        </h2>
      </div>
      <nav>
        <ul>
          <li>
            <router-link
              to="/products"
              class="block px-4 py-2 hover:bg-gray-700"
            >
              Products
            </router-link>
          </li>
          <li>
            <router-link
              to="/suppliers"
              class="block px-4 py-2 hover:bg-gray-700"
            >
              Suppliers
            </router-link>
          </li>
          <li>
            <router-link
              to="/purchases"
              class="block px-4 py-2 hover:bg-gray-700"
            >
              Purchases
            </router-link>
          </li>
          <li>
            <router-link
              to="/supplier-ledgers"
              class="block px-4 py-2 hover:bg-gray-700"
            >
              Supplier Ledgers
            </router-link>
          </li>
        </ul>
      </nav>
    </aside>

    <div class="flex-1 flex flex-col">
      <header class="bg-gray-100 p-4 shadow flex justify-between items-center">
        <h1 class="text-lg font-bold">Dashboard</h1>
        <Logout />
      </header>

      <main class="flex-1 p-6 bg-gray-50 overflow-auto">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
import Logout from "@/components/Logout.vue";
export default {
  name: "DefaultLayout",
  components: {
    Logout,
  },
};
</script>
