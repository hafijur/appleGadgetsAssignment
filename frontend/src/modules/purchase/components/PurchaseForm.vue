<template>
  <div class="p-4 border outline-none bg-gray-50">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Create Purchase</h2>
      <button @click="$emit('close')" class="text-gray-500 hover:text-gray-700">
        ✕
      </button>
    </div>

    <form @submit.prevent="handleSubmit">
      <!-- Supplier Selection -->

      <div class="flex">
        <div class="w-1/3 pr-4">
          <div class="mb-4">
            <label for="supplier" class="block text-sm font-medium"
              >Supplier</label
            >
            <select
              v-model="form.supplier_id"
              id="supplier"
              class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
            >
              <option
                v-for="supplier in suppliers"
                :key="supplier.supplier_id"
                :value="supplier.supplier_id"
              >
                {{ supplier.name }}
              </option>
            </select>
          </div>

          <!-- Purchase Date -->
          <div class="mb-4">
            <label for="purchase_date" class="block text-sm font-medium"
              >Purchase Date</label
            >
            <input
              v-model="form.purchase_date"
              id="purchase_date"
              type="date"
              class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
            />
          </div>
          <!-- Product Search -->
          <div class="mb-4">
            <label for="product_search" class="block text-sm font-medium"
              >Search Product</label
            >
            <input
              v-model="searchQuery"
              @input="searchProducts"
              id="product_search"
              type="text"
              placeholder="Search by name"
              class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
            />
            <ul
              v-if="searchResults.length"
              class="bg-white border border-gray-200 outline-none mt-2"
            >
              <li
                v-for="product in searchResults"
                :key="product.product_id"
                @click="addItem(product)"
                class="p-2 hover:bg-gray-100 cursor-pointer"
              >
                {{ product.name }} ({{ product.price }})
              </li>
            </ul>
          </div>
        </div>
        <!-- Items Table -->
        <div class="w-2/3">
          <table class="min-w-full bg-white border border-gray-200">
            <thead>
              <tr>
                <th class="py-2 px-4 border-b">Product</th>
                <th class="py-2 px-4 border-b">Quantity</th>
                <th class="py-2 px-4 border-b">Unit Price</th>
                <th class="py-2 px-4 border-b">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in form.items" :key="index">
                <td class="py-2 px-4 border-b">{{ item.name }}</td>
                <td class="py-2 px-4 border-b">
                  <input
                    v-model.number="item.quantity"
                    type="number"
                    class="w-16 border-gray-300 outline-none"
                    min="1"
                  />
                </td>
                <td class="py-2 px-4 border-b">{{ item.unit_price }}</td>
                <td class="py-2 px-4 border-b">
                  <button
                    @click="removeItem(index)"
                    class="text-red-600 hover:underline"
                  >
                    Remove
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="submit"
          class="py-2 px-4 bg-indigo-600 text-white outline-none hover:bg-indigo-700"
        >
          Create Purchase
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { fetchProductsByName } from "../services/purchaseService";

export default {
  name: "PurchaseForm",
  props: {
    suppliers: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      form: {
        supplier_id: null,
        purchase_date: "",
        items: [],
      },
      searchQuery: "",
      searchResults: [],
    };
  },
  methods: {
    async searchProducts() {
      if (!this.searchQuery.trim()) {
        this.searchResults = [];
        return;
      }
      try {
        const response = await fetchProductsByName(this.searchQuery);
        console.log("search result is ", response.data);
        this.searchResults = response.data;
      } catch (error) {
        console.error("Error searching products:", error);
      }
    },
    addItem(product) {
      const existingItem = this.form.items.find(
        (item) => item.product_id === product.product_id
      );
      if (!existingItem) {
        this.form.items.push({
          product_id: product.product_id,
          name: product.name,
          quantity: 1,
          unit_price: product.price,
        });
      }
      this.searchResults = [];
      this.searchQuery = "";
    },
    removeItem(index) {
      this.form.items.splice(index, 1);
    },
    handleSubmit() {
      if (
        !this.form.supplier_id ||
        !this.form.purchase_date ||
        !this.form.items.length
      ) {
        alert("Please fill in all fields and add at least one item.");
        return;
      }
      this.$emit("submit", { ...this.form });
    },
  },
};
</script>
