<template>
  <div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Supplier Ledger</h1>
    </div>

    <SupplierLedgerForm @addEntry="createLedgerEntry" :suppliers="suppliers" />
    <!-- Ledger Entry Form -->
    <div class="flex space-x-4 mt-4">
      <div>
        <label for="start_date" class="block text-sm font-medium"
          >Start Date</label
        >
        <input
          type="date"
          v-model="filters.startDate"
          class="py-2 px-3 border rounded"
        />
      </div>

      <div>
        <label for="end_date" class="block text-sm font-medium">End Date</label>
        <input
          type="date"
          v-model="filters.endDate"
          class="py-2 px-3 border rounded"
        />
      </div>

      <div class="mb-4">
        <label for="supplier" class="block text-sm font-medium">Supplier</label>
        <select
          v-model="filters.supplier_id"
          id="supplier"
          class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
        >
          <option value="">Select Supplier</option>
          <option
            v-for="supplier in suppliers"
            :key="supplier.supplier_id"
            :value="supplier.supplier_id"
          >
            {{ supplier.name }}
          </option>
        </select>
      </div>

      <button
        @click="filterLedger"
        class="px-4 bg-indigo-600 text-white outline-none hover:bg-indigo-700"
      >
        Filter
      </button>
    </div>

    <!-- Ledger Table -->
    <SupplierLedgerTable :ledgers="ledgers" />

    <!-- Filter Controls -->
  </div>
</template>

<script>
import SupplierLedgerForm from "../components/SupplierLedgerForm.vue";
import SupplierLedgerTable from "../components/SupplierLedgerTable.vue";
import { fetchLedgers, createLedger } from "../services/supplierLedgerService";
import { fetchSuppliers } from "@/modules/supplier/services/supplierService";

export default {
  name: "SupplierLedgerView",
  components: { SupplierLedgerForm, SupplierLedgerTable },
  data() {
    return {
      ledgers: [], // Ledger entries will be stored here
      suppliers: [],
      filters: {
        startDate: null,
        endDate: null,
        supplier_id: null,
      },
    };
  },

  async created() {
    await this.loadLedgers(); // Fetch ledger data when the component is created
    await this.loadSuppliers(1, "all");
  },

  methods: {
    async loadLedgers(page = 1, filters = {}) {
      try {
        const response = await fetchLedgers(page, filters); // API call to fetch ledger data
        this.ledgers = response.data;
      } catch (error) {
        console.error("Error loading ledgers:", error);
        this.$swal({
          icon: "error",
          title: "Oops...",
          text: "Failed to load ledger data.",
        });
      }
    },
    async loadSuppliers(page = 1, limit = 10, filters = {}) {
      try {
        const response = await fetchSuppliers(page, limit, (filters = {}));
        this.suppliers = response.data;
      } catch (error) {
        console.error("Error loading suppliers:", error);
        this.$swal({
          icon: "error",
          title: "Oops...",
          text: "Failed to load supplier data.",
        });
      }
    },
    async createLedgerEntry(entry) {
      try {
        const response = await createLedger(entry); // API call to create a new ledger entry
        this.loadLedgers(); // Reload ledger data after creating a new entry
      } catch (error) {
        console.error("Error creating ledger entry:", error);
        const errorMessage =
          error.response?.data?.message || "Failed to create ledger entry.";
        this.$swal({
          icon: "error",
          title: "Oops...",
          text: errorMessage,
        });
      }
    },
    filterLedger() {
      const filters = {
        start_date: this.filters.startDate,
        end_date: this.filters.endDate,
        supplier_id: this.filters.supplier_id,
      };
      this.loadLedgers(1, filters);
      filters.startDate = null;
      filters.endDate = null;
      filters.supplier_id = null;
    },
  },
};
</script>
