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
    <PurchaseOrder
      :show="showModal"
      :purchaseItems="purchaseItems"
      @close="closeModal"
    />

    <PurchaseForm
      v-if="showForm"
      :submitDisabled="submitDisabled"
      :suppliers="suppliers"
      @submit="createPurchase"
      @close="closeForm"
    />

    <!-- Purchase List -->
    <PurchaseList
      :purchases="purchases"
      :meta="meta"
      @detail="openModal"
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
import PurchaseOrder from "../components/PurchaseOrder.vue";

export default {
  name: "PurchaseView",
  components: { PurchaseForm, PurchaseList, PurchaseOrder },
  data() {
    return {
      purchases: [],
      meta: {},
      suppliers: [], // Load from API
      showForm: false,
      submitDisabled: false,
      showModal: false,
      purchaseItems: [],
    };
  },
  async created() {
    await this.loadPurchases();
    await this.loadSuppliers();
  },
  methods: {
    openModal(purchase) {
      console.log("Open modal Purchase:", purchase);

      this.purchaseItems = purchase.purchase_items;

      this.showModal = true;
      console.log("Open modal Purchase:", this.purchaseItems);
    },
    closeModal() {
      this.showModal = false;
    },
    async loadPurchases() {
      try {
        const response = await fetchPurchases();

        this.purchases = response.data;
        this.meta = response.meta;
      } catch (error) {
        this.showErrors(error.response.data);
        console.error("Error fetching purchases:", error);
      }
    },
    async loadSuppliers() {
      try {
        // Load suppliers from your supplier service
        const response = await fetchSuppliers(1, "all");
        this.suppliers = response.data;
      } catch (error) {
        this.showErrors(error.response.data);
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
        this.showErrors(error.response.data);
        console.error("Error fetching purchases:", error);
      }
    },
    async prevPage() {
      try {
        const response = await fetchPurchases(this.meta.current_page - 1);
        this.purchases = response.data;
        this.meta = response.meta;
      } catch (error) {
        this.showErrors(error.response.data);
        console.error("Error fetching purchases:", error);
      }
    },
    async createPurchase(purchase) {
      this.submitDisabled = true;
      try {
        const response = await createPurchase(purchase);
        this.loadPurchases();
        this.closeForm();
      } catch (error) {
        this.showErrors(error.response.data);
        console.error("Error creating purchase:", error);
      }
      this.submitDisabled = false;
    },
  },
};
</script>
