<template>
  <form @submit.prevent="handleSubmit" class="space-y-4 bg-gray-50 p-4 rounded">
    <h2 class="text-lg font-semibold">Add Ledger Entry</h2>
    <div class="space-y-2">
      <div class="mb-4">
        <label for="supplier" class="block text-sm font-medium"
          >Select Supplier</label
        >
        <select
          v-model="entry.supplier_id"
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
      <div>
        <label class="block text-sm font-medium">Transaction Date</label>
        <input
          type="date"
          v-model="entry.transaction_date"
          required
          class="w-full py-2 px-3 border rounded"
        />
      </div>
      <div>
        <label class="block text-sm font-medium">Amount</label>
        <input
          type="number"
          v-model="entry.debit"
          placeholder="0.00"
          min="0"
          step="0.01"
          class="w-full py-2 px-3 border rounded"
        />
      </div>

      <div>
        <label class="block text-sm font-medium">Remarks</label>
        <textarea
          v-model="entry.remarks"
          placeholder="Enter remarks"
          class="w-full py-2 px-3 border rounded"
        ></textarea>
      </div>
    </div>
    <button
      type="submit"
      class="py-2 px-4 bg-indigo-600 text-white outline-none hover:bg-indigo-700"
    >
      Add Entry
    </button>
  </form>
</template>

<script>
export default {
  name: "SupplierLedgerForm",
  props: {
    suppliers: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      entry: {
        transaction_date: this.getCurrentDate(),
        supplier_id: "",
        debit: 0,
        credit: 0,
        balance: 0,
        remarks: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      const newEntry = { ...this.entry, ledger_id: Date.now() };
      this.$emit("addEntry", newEntry); // Emit the entry to the parent component
      this.resetForm();
    },
    resetForm() {
      this.entry = {
        transaction_date: "",
        supplier_id: "",
        debit: 0,
        credit: 0,
        balance: 0,
        remarks: "",
      };
    },
  },
};
</script>
