<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
  >
    <div class="bg-white w-full max-w-3xl rounded-lg shadow-lg">
      <!-- Modal Header -->
      <div class="flex justify-between items-center p-4 border-b">
        <h2 class="text-lg font-semibold">Purchase Order Details</h2>
        <button
          @click="closeModal"
          class="text-gray-400 hover:text-gray-600 focus:outline-none"
        >
          ✕
        </button>
      </div>

      <!-- Modal Content -->
      <div class="p-4">
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white border border-gray-200">
            <thead>
              <tr>
                <th class="py-2 px-4 border-b border-gray-200 text-left">#</th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">
                  Product Name
                </th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">
                  Quantity
                </th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">
                  Unit Price
                </th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">
                  Total
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(item, index) in purchaseItems"
                :key="index"
                class="hover:bg-gray-50"
              >
                <td class="py-2 px-4 border-b border-gray-200">
                  {{ index + 1 }}
                </td>
                <td class="py-2 px-4 border-b border-grayPurchaseOrder-200">
                  {{ item.product.name }}
                </td>
                <td class="py-2 px-4 border-b border-gray-200">
                  {{ item.quantity }}
                </td>
                <td class="py-2 px-4 border-b border-gray-200">
                  {{ formatCurrency(item.unit_price) }}
                </td>
                <td class="py-2 px-4 border-b border-gray-200">
                  {{ formatCurrency(item.total_price) }}
                </td>
              </tr>
              <tr>
                <td colspan="4" class="py-2 px-4 border-b border-gray-200">
                  <strong>Total Amount</strong>
                </td>
                <td class="py-2 px-4 border-b border-gray-200">
                  <strong>
                    {{
                      formatCurrency(
                        purchaseItems.reduce(
                          (acc, item) => Number(acc) + Number(item.total_price),
                          0
                        )
                      )
                    }}
                  </strong>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="flex justify-end items-center p-4 border-t">
        <button
          @click="closeModal"
          class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-600"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PurchaseOrder",
  props: {
    show: {
      type: Boolean,
      required: true,
    },
    purchaseItems: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  methods: {
    closeModal() {
      this.$emit("close");
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "BDT",
      }).format(value);
    },
  },
};
</script>
