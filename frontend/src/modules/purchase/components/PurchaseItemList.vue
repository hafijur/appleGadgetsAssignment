<template>
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
      <tr v-for="item in purchase_items" :key="item.purchase_item_id">
        <td class="py-2 px-4">{{ item.product.name }}</td>
        <td class="py-2 px-4">{{ item.quantity }}</td>
        <td class="py-2 px-4">{{ item.unit_price }}</td>
        <td class="py-2 px-4">{{ item.total_price }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "PurchaseItemList",
  props: {
    purchase_items: {
      type: Array,
      required: true,
    },
  },
};
</script>
