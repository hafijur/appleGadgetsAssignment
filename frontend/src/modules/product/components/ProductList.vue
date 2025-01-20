<template>
  <div v-if="products.length > 0" class="p-6">
    <h1 class="text-2xl font-bold mb-4">Product List</h1>
    <table class="min-w-full table-auto border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2">Name</th>
          <th class="border border-gray-300 px-4 py-2">SKU</th>
          <th class="border border-gray-300 px-4 py-2">Price</th>
          <th class="border border-gray-300 px-4 py-2">Stock</th>
          <th class="border border-gray-300 px-4 py-2">Category</th>
          <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="product in products"
          :key="product.product_id"
          class="hover:bg-gray-50"
        >
          <td class="border border-gray-300 px-4 py-2">{{ product.name }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ product.SKU }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ product.price }}</td>
          <td class="border border-gray-300 px-4 py-2">
            {{ product.current_stock_quantity }}
          </td>
          <td class="border border-gray-300 px-4 py-2">
            {{ product.category_name }}
          </td>
          <td class="border border-gray-300 px-4 py-2 text-center space-x-2">
            <button
              class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
              @click="$emit('edit-product', product)"
            >
              Edit
            </button>
            <button
              class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
              @click="$emit('delete-product', product.product_id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-else class="p-6 text-gray-500">No products available.</div>
</template>

<script>
export default {
  name: "ProductList",
  props: {
    products: {
      type: Array,
      required: true,
    },
  },
};
</script>
