<template>
  <div class="p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Product Management</h1>
      <button
        @click="openCreateForm"
        class="inline-flex items-center py-2 px-4 border border-transparent text-sm font-medium outline-none text-white bg-indigo-600 hover:bg-indigo-700"
      >
        + Add Product
      </button>
    </div>

    <!-- Product Form (Create/Edit) -->
    <ProductForm
      v-if="showForm"
      :categories="categories"
      :key="selectedProduct?.product_id || 'new'"
      :submitDisabled="submitDisabled"
      :initialProduct="selectedProduct || {}"
      :formMode="selectedProduct ? 'edit' : 'create'"
      @submit="handleFormSubmit"
      @close="closeForm"
    />

    <!-- filter -->

    <div class="flex space-x-4 mt-4 items-center">
      <div>
        <label for="product" class="block text-sm font-medium"
          >Product Name</label
        >
        <input
          type="text"
          v-model="filters.name"
          class="py-2 px-3 border rounded"
        />
      </div>

      <div>
        <label for="product" class="block text-sm font-medium"
          >Product SKU</label
        >
        <input
          type="text"
          v-model="filters.SKU"
          class="py-2 px-3 border rounded"
        />
      </div>

      <div>
        <label for="supplier" class="block text-sm font-medium"
          >Categories</label
        >
        <select
          v-model="filters.category_id"
          id="supplier"
          class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
        >
          <option value="">Select Category</option>
          <option
            v-for="category in categories"
            :key="category.category_id"
            :value="category.category_id"
          >
            {{ category.name }}
          </option>
        </select>
      </div>

      <button
        @click="filterProduct"
        class="h-[42px] px-10 bg-indigo-600 text-white outline-none hover:bg-indigo-700 self-end"
      >
        Filter
      </button>
    </div>

    <!-- Product Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b border-gray-200 text-left">SL</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">Name</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">SKU</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Category
            </th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">Price</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Initial Stock Quantity
            </th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Current Stock Quantity
            </th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(product, index) in products"
            :key="product.product_id"
            class="hover:bg-gray-50"
          >
            <td class="py-2 px-4 border-b border-gray-200">
              {{
                meta.current_page * meta.per_page - meta.per_page + index + 1
              }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ product.name }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ product.SKU }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ product.category_name || "Unknown Category" }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ product.price }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ product.initial_stock_quantity }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ product.current_stock_quantity }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              <button
                @click="openEditForm(product)"
                class="text-blue-600 hover:underline"
              >
                Edit
              </button>
              |
              <button
                @click="deleteProduct(product.product_id)"
                class="text-red-600 hover:underline"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="flex justify-end items-center space-x-2 mt-4">
      <button
        @click="prevPage"
        :disabled="meta.current_page === 1"
        class="py-1 px-3 text-sm border outline-none bg-gray-100 hover:bg-gray-200 disabled:opacity-50"
      >
        Previous
      </button>
      <span class="text-sm"
        >Page {{ meta.current_page }} of {{ meta.last_page }}</span
      >
      <button
        @click="nextPage"
        :disabled="meta.current_page === meta.last_page"
        class="py-1 px-3 text-sm border outline-none bg-gray-100 hover:bg-gray-200 disabled:opacity-50"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script>
import {
  fetchProducts,
  deleteProduct,
  createProduct,
  updateProduct,
  fetchCategories,
} from "../services/productService";
import ProductForm from "../components/ProductForm.vue";

export default {
  name: "ProductView",
  components: { ProductForm },
  data() {
    return {
      products: [],
      filters: {
        category_id: null,
        name: "",
        SKU: "",
      },
      categories: [],
      submitDisabled: false, // Disable submit button while submitting
      meta: {}, // Pagination meta data
      selectedProduct: null, // Used for editing a product
      showForm: false, // Toggle for showing the form
    };
  },

  async created() {
    await this.loadProducts();
    await this.loadCategories();
  },
  methods: {
    async loadProducts(page = 1, filters = {}) {
      try {
        const response = await fetchProducts(page, 10, filters);
        this.products = response.data; // Assuming API response has a "data" field
        this.meta = response.meta; // Assuming API response has a "meta" field
      } catch (error) {
        this.showError(error.response.data);
        console.error("Error fetching products:", error);
      }
    },
    async loadCategories() {
      try {
        const response = await fetchCategories();
        this.categories = response.data;
      } catch (error) {
        this.showError(error.response.data);
        console.error("Error fetching categories:", error);
      }
    },
    openCreateForm() {
      this.showForm = true;
      this.selectedProduct = null; // Reset form for creating a new product
    },
    closeForm() {
      this.showForm = false;
      this.selectedProduct = null;
    },
    openEditForm(product) {
      this.selectedProduct = { ...product }; // Clone the product for editing
      this.showForm = true;
    },
    async handleFormSubmit(product) {
      this.submitDisabled = true; // Disable the submit button
      if (this.selectedProduct) {
        try {
          const updatedProduct = await updateProduct(
            product.product_id,
            product
          );
          this.loadProducts();
        } catch (error) {
          this.showError(error.response.data);
          console.error("Error updating product:", error);
        }
      } else {
        try {
          const newProduct = await createProduct(product);
          this.loadProducts();
        } catch (error) {
          this.showError(error.response.data);
        }
      }
      this.showForm = false; // Hide the form
      this.submitDisabled = false; // Reset selected product
    },
    async deleteProduct(productId) {
      try {
        await deleteProduct(productId);
        this.products = this.products.filter(
          (product) => product.product_id !== productId
        ); // Remove from the list
      } catch (error) {
        this.showError(error.response.data);
        console.error("Error deleting product:", error);
      }
    },
    async nextPage() {
      try {
        const response = await fetchProducts(this.meta.current_page + 1);
        this.products = response.data;
        this.meta = response.meta;
      } catch (error) {
        this.showError(error.response.data);
        console.error("Error fetching products:", error);
      }
    },
    async prevPage() {
      try {
        const response = await fetchProducts(this.meta.current_page - 1);
        this.products = response.data;
        this.meta = response.meta;
      } catch (error) {
        this.showError(error.response.data);
        console.error("Error fetching products:", error);
      }
    },
    filterProduct() {
      console.log("filters", this.filters);
      this.loadProducts(1, this.filters);
    },
  },
};
</script>
