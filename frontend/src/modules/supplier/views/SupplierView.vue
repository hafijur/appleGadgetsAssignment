<template>
  <div class="p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Supplier Management</h1>
      <button
        @click="openCreateForm"
        class="inline-flex items-center py-2 px-4 border border-transparent text-sm font-medium outline-none text-white bg-indigo-600 hover:bg-indigo-700"
      >
        + Add Supplier
      </button>
    </div>

    <!-- Supplier Form (Create/Edit) -->
    <SupplierForm
      v-if="showForm"
      :submitDisabled="submitDisabled"
      :initialSupplier="selectedSupplier || {}"
      :formMode="selectedSupplier ? 'edit' : 'create'"
      @submit="handleFormSubmit"
      @close="closeForm"
    />

    <!-- Supplier Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b border-gray-200 text-left">SL</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">Name</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Contact Info
            </th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Address
            </th>
            <th class="py-2 px-4 border-b border-gray-200 text-left">
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(supplier, index) in suppliers"
            :key="supplier.supplier_id"
            class="hover:bg-gray-50"
          >
            <td class="py-2 px-4 border-b border-gray-200">
              {{
                meta.current_page * meta.per_page - meta.per_page + index + 1
              }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ supplier.name }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ supplier.contact_info }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              {{ supplier.address }}
            </td>
            <td class="py-2 px-4 border-b border-gray-200">
              <button
                @click="openEditForm(supplier)"
                class="text-blue-600 hover:underline"
              >
                Edit
              </button>
              |
              <button
                @click="deleteSupplier(supplier.supplier_id)"
                Products
                class="text-red-600 hover:underline"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
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
  fetchSuppliers,
  createSupplier,
  updateSupplier,
  deleteSupplier,
} from "../services/supplierService";
import SupplierForm from "../components/SupplierForm.vue";

export default {
  name: "SupplierView",
  components: { SupplierForm },
  data() {
    return {
      suppliers: [],
      meta: {}, // Pagination meta data
      selectedSupplier: null,
      showForm: false,
      submitDisabled: false,
    };
  },

  async created() {
    await this.loadSuppliers();
  },
  methods: {
    async loadSuppliers() {
      try {
        const response = await fetchSuppliers();
        console.log("suppliers:", response);
        this.suppliers = response.data;
        this.meta = response.meta;
      } catch (error) {
        if ("errors" in error.response.data) {
          const messages = Object.values(error.response.data.errors)
            .flat()
            .join("\n");
          this.$swal({
            icon: "error",
            title: "Oops..." + error.response.data.message,
            text: messages,
          });
        } else {
          this.$swal({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message,
          });
        }
        console.error("Error fetching suppliers:", error);
      }
    },
    openCreateForm() {
      this.showForm = true;
      this.selectedSupplier = null;
    },
    openEditForm(supplier) {
      this.showForm = true;
      this.selectedSupplier = { ...supplier };
    },
    closeForm() {
      this.showForm = false;
      this.selectedSupplier = null;
    },
    async handleFormSubmit(supplier) {
      this.submitDisabled = true;
      if (this.selectedSupplier) {
        console.log("Updating supplier:", supplier); // Debugging
        try {
          const updatedSupplier = await updateSupplier(
            supplier.supplier_id,
            supplier
          );
          console.log("Updated supplier response:", updatedSupplier); // Debugging

          const index = this.suppliers.findIndex(
            (s) => s.supplier_id === supplier.supplier_id
          );
          if (index !== -1) this.suppliers[index] = updatedSupplier.data;
        } catch (error) {
          if ("errors" in error.response.data) {
            const messages = Object.values(error.response.data.errors)
              .flat()
              .join("\n");
            this.$swal({
              icon: "error",
              title: "Oops..." + error.response.data.message,
              text: messages,
            });
          } else {
            this.$swal({
              icon: "error",
              title: "Oops...",
              text: error.response.data.message,
            });
          }
          console.error("Error updating supplier:", error);
        }
      } else {
        // Create Supplier
        try {
          const newSupplier = await createSupplier(supplier);
          if (this.suppliers.length < this.meta.per_page) {
            this.suppliers.push(newSupplier.data);
          } else {
            this.loadSuppliers();
          }
        } catch (error) {
          if ("errors" in error.response.data) {
            const messages = Object.values(error.response.data.errors)
              .flat()
              .join("\n");
            this.$swal({
              icon: "error",
              title: "Oops..." + error.response.data.message,
              text: messages,
            });
          } else {
            this.$swal({
              icon: "error",
              title: "Oops...",
              text: error.response.data.message,
            });
          }
          console.error("Error creating supplier:", error);
        }
      }
      this.closeForm();
      this.submitDisabled = false;
    },
    async deleteSupplier(id) {
      try {
        await deleteSupplier(id);
        this.suppliers = this.suppliers.filter((s) => s.supplier_id !== id);
      } catch (error) {
        if ("errors" in error.response.data) {
          const messages = Object.values(error.response.data.errors)
            .flat()
            .join("\n");
          this.$swal({
            icon: "error",
            title: "Oops..." + error.response.data.message,
            text: messages,
          });
        } else {
          this.$swal({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message,
          });
        }
        console.error("Error deleting supplier:", error);
      }
    },
    async nextPage() {
      try {
        console.log("Next page clicked", this.meta.current_page + 1);
        const response = await fetchSuppliers(this.meta.current_page + 1);
        this.suppliers = response.data;
        this.meta = response.meta;
      } catch (error) {
        if ("errors" in error.response.data) {
          const messages = Object.values(error.response.data.errors)
            .flat()
            .join("\n");
          this.$swal({
            icon: "error",
            title: "Oops..." + error.response.data.message,
            text: messages,
          });
        } else {
          this.$swal({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message,
          });
        }
        console.error("Error fetching suppliers:", error);
      }
    },
    async prevPage() {
      try {
        const response = await fetchSuppliers(this.meta.current_page - 1);
        this.suppliers = response.data;
        this.meta = response.meta;
      } catch (error) {
        if ("errors" in error.response.data) {
          const messages = Object.values(error.response.data.errors)
            .flat()
            .join("\n");
          this.$swal({
            icon: "error",
            title: "Oops..." + error.response.data.message,
            text: messages,
          });
        } else {
          this.$swal({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message,
          });
        }
        console.error("Error fetching suppliers:", error);
      }
    },
  },
};
</script>
