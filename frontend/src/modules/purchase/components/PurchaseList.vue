<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Purchase List</h2>
    <div v-if="purchases.length === 0" class="text-gray-500">
      No purchases found.
    </div>

    <table v-else class="min-w-full bg-white border border-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="py-2 px-4 border-b text-left">SL</th>
          <th class="py-2 px-4 border-b text-left">Date</th>
          <th class="py-2 px-4 border-b text-left">Supplier</th>
          <th class="py-2 px-4 border-b text-left">Total Amount</th>
          <th class="py-2 px-4 border-b">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(purchase, index) in purchases"
          :key="purchase.purchase_id"
          class="border-b"
        >
          <td class="py-2 px-4">
            {{ meta.current_page * meta.per_page - meta.per_page + index + 1 }}</td>
          <td class="py-2 px-4">{{ purchase.purchase_date }}</td>
          <td class="py-2 px-4">
            {{ purchase.supplier?.name || "Unknown Supplier" }}
          </td>
          <td class="py-2 px-4">₹{{ purchase.total_amount }}</td>
          <td class="py-2 px-4">
            <button
              @click="toggleDetails(purchase.purchase_id)"
              class="py-1 px-3 bg-indigo-600 text-white outline-none hover:bg-indigo-700"
            >
              {{
                expandedPurchase === purchase.purchase_id ? "Hide" : "Details"
              }}
            </button>
          </td>
          <!-- Collapsible Row for Purchase Items -->
          <tr
            v-if="expandedPurchase === purchase.purchase_id"
            class="bg-gray-50"
            v-for="(purchase,index) in purchases"
            :key="`${purchase.purchase_id}-details`"
          >
            <td  colspan="5" class="py-4 px-6">
              <h3 class="font-semibold mb-2">Purchase Items</h3>
              <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                  <tr>
                    <th class="py-2 px-4 border-b text-left">Product Name</th>
                    <th class="py-2 px-4 border-b text-left">Quantity</th>
                    <th class="py-2 px-4 border-b text-left">Unit Price</th>
                    <th class="py-2 px-4 border-b text-left">Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="item in purchase.purchase_items"
                    :key="item.purchase_item_id"
                  >
                    <td class="py-2 px-4">{{ item.product.name }}</td>
                    <td class="py-2 px-4">{{ item.quantity }}</td>
                    <td class="py-2 px-4">₹{{ item.unit_price }}</td>
                    <td class="py-2 px-4">₹{{ item.total_price }}</td>
                  </tr>
                </tbody>
              </table>
  
              <div
                v-if="purchase.purchase_items.length === 0"
                class="text-gray-500 mt-2"
              >
                No items found for this purchase.
              </div>
            </td>
          </tr>
        </tr>

      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center">
      <button
        :disabled="meta.current_page === 1"
        @click="$emit('prevPage')"
        class="py-1 px-3 bg-gray-200 text-gray-700 outline-none hover:bg-gray-300 disabled:opacity-50"
      >
        Previous
      </button>
      <span>Page {{ meta.current_page }} of {{ meta.last_page }}</span>
      <button
        :disabled="meta.current_page === meta.last_page"
        @click="$emit('nextPage')"
        class="py-1 px-3 bg-gray-200 text-gray-700 outline-none hover:bg-gray-300 disabled:opacity-50"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "PurchaseList",
  props: {
    purchases: {
      type: Array,
      required: true,
    },
    meta: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      expandedPurchase: null,
    };
  },
  methods: {
    toggleDetails(purchaseId) {
      this.expandedPurchase =
        this.expandedPurchase === purchaseId ? null : purchaseId;
    },
  },
};
</script>
