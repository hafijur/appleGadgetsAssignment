<template>
  <div class="p-4 border outline-none bg-gray-50">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">
        {{ formMode === "edit" ? "Edit Supplier" : "Create Supplier" }}
      </h2>
      <button
        @click="$emit('close')"
        class="text-gray-500 hover:text-gray-700 focus: outline-none"
      >
        ✕
      </button>
    </div>
    <form @submit.prevent.stop="handleSubmit">
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-medium">Name</label>
          <input
            v-model="form.name"
            id="name"
            type="text"
            class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
          />
        </div>
        <div>
          <label for="contact_info" class="block text-sm font-medium"
            >Contact Info</label
          >
          <input
            v-model="form.contact_info"
            id="contact_info"
            type="text"
            class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
          />
        </div>
        <div>
          <label for="address" class="block text-sm font-medium">Address</label>
          <input
            v-model="form.address"
            id="address"
            type="text"
            class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none shadow-sm"
          />
        </div>
      </div>
      <div class="mt-4 flex justify-end space-x-4">
        <button 
          type="button"
          @click="$emit('close')"
          class="py-2 px-4 border border-gray-300 outline-none text-sm bg-white hover:bg-gray-100"
        >
          Cancel
        </button>
        <button :disabled="submitDisabled"
          type="submit"
          class="py-2 px-4 border border-transparent outline-none text-sm text-white bg-indigo-600 hover:bg-indigo-700"
        >
          {{ formMode === "edit" ? "Update" : "Create" }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "SupplierForm",
  props: {
    initialSupplier: {
      type: Object,
      default: () => ({}),
    },
    formMode: {
      type: String,
      default: "create", // "create" or "edit"
    },
    submitDisabled: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      form: { ...this.initialSupplier },
    };
  },
  methods: {
    handleSubmit() {
      this.$emit("submit", this.form);
    },
  },
};
</script>
