<template>
  <div class="flex h-screen">
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
      <div class="p-6">
        <h2 class="text-2xl font-bold">My App</h2>
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
        </ul>
      </nav>
    </aside>

    <div class="flex-1 flex flex-col">
      <header class="bg-gray-100 p-4 shadow">
        <h1 class="text-lg font-bold">Dashboard</h1>
      </header>

      <main class="flex-1 p-6 bg-gray-50 overflow-auto">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
export default {
  name: "DefaultLayout",
};
</script>
