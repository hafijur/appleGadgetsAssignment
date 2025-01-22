<template>
  <div class="overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-200">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2">Supplier</th>
          <th class="border px-4 py-2">Transaction Date</th>
          <th class="border px-4 py-2">Remarks</th>
          <th class="border px-4 py-2">Debit</th>
          <th class="border px-4 py-2">Credit</th>
          <th class="border px-4 py-2">Balance</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="ledger in ledgers"
          :key="ledger.ledger_id"
          class="hover:bg-gray-50"
        >
          <td class="border px-4 py-2">{{ ledger.supplier?.name }}</td>
          <td class="border px-4 py-2">{{ ledger.transaction_date }}</td>
          <td class="border px-4 py-2">{{ ledger.remarks }}</td>
          <td class="border px-4 py-2">{{ ledger.debit }}</td>
          <td class="border px-4 py-2">{{ ledger.credit }}</td>
          <td class="border px-4 py-2">{{ ledger.balance }}</td>
        </tr>
        <tr>
          <td class="border px-4 py-2"></td>
          <td class="border px-4 py-2"></td>
          <td class="border px-4 py-2 text-right">Total</td>
          <td class="border px-4 py-2">
            {{ this.totals.debit }}
          </td>
          <td class="border px-4 py-2">
            {{ this.totals.credit }}
          </td>
          <td class="border px-4 py-2">
            {{ this.totals.debit - this.totals.credit }}
          </td>
        </tr>

        <tr v-if="ledgers.length === 0">
          <td class="border px-4 py-2 text-center" :colspan="6">
            No ledger entries found
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "SupplierLedgerTable",
  props: {
    ledgers: {
      type: Array,
      required: true,
    },
  },
  computed: {
    totals() {
      // it will return an object with total debit, credit and balance
      return this.ledgers.reduce(
        (acc, ledger) => {
          acc.debit += Number(ledger.debit);
          acc.credit += Number(ledger.credit);
          return acc;
        },
        { debit: 0, credit: 0 }
      );
    },
  },
};
</script>
