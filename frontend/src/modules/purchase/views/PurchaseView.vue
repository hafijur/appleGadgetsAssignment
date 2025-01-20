<template>
  <div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Purchase Management</h1>
      <button
        @click="openForm"
        class="py-2 px-4 bg-indigo-600 text-white outline-none hover:bg-indigo-700"
      >
        + Add Purchase
      </button>
    </div>

    <PurchaseForm
      v-if="showForm"
      :suppliers="suppliers"
      @submit="createPurchase"
      @close="closeForm"
    />

    <!-- Purchase List -->
    <PurchaseList
      :purchases="purchases"
      :meta="meta"
      @nextPage="nextPage"
      @prevPage="prevPage"
    />
  </div>
</template>

<script>
import { fetchPurchases, createPurchase } from "../services/purchaseService";
import PurchaseForm from "../components/PurchaseForm.vue";
import PurchaseList from "../components/PurchaseList.vue";
import { fetchSuppliers } from "@/modules/supplier/services/supplierService";

export default {
  name: "PurchaseView",
  components: { PurchaseForm, PurchaseList },
  data() {
    return {
      purchases: [],
      meta: {},
      suppliers: [], // Load from API
      showForm: false,
    };
  },
  async created() {
    await this.loadPurchases();
    await this.loadSuppliers();
  },
  methods: {
    async loadPurchases() {
      try {
        const response = await fetchPurchases();

        this.purchases = response.data;
        this.meta = response.meta;
      } catch (error) {
        console.error("Error fetching purchases:", error);
      }
    },
    async loadSuppliers() {
      try {
        // Load suppliers from your supplier service
        const response = await fetchSuppliers();
        this.suppliers = response.data;
      } catch (error) {
        console.error("Error fetching suppliers:", error);
      }
    },
    openForm() {
      this.showForm = true;
    },
    closeForm() {
      this.showForm = false;
    },
    async nextPage() {
      try {
        const response = await fetchPurchases(this.meta.current_page + 1);
        this.purchases = response.data;
        this.meta = response.meta;
      } catch (error) {
        console.error("Error fetching purchases:", error);
      }
    },
    async prevPage() {
      try {
        const response = await fetchPurchases(this.meta.current_page - 1);
        this.purchases = response.data;
        this.meta = response.meta;
      } catch (error) {
        console.error("Error fetching purchases:", error);
      }
    },
    async createPurchase(purchase) {
      try {
        const response = await createPurchase(purchase);
        if (this.purchases.length < this.meta.per_page) {
          this.purchases.push(response.data);
        } else {
          this.loadPurchases();
        }
        this.closeForm();
      } catch (error) {
        console.error("Error creating purchase:", error);
      }
    },
  },
};
</script>
