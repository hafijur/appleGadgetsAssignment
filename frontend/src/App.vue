<template>
  <div id="app">
    <div>
    <component v-if="layout" :is="layout">
      <router-view />
    </component>
    <router-view v-else />
  </div>
  </div>
</template>

<script>
import DefaultLayout from "./layouts/DefaultLayout.vue";

export default {
  name: "App",
  components: { DefaultLayout },
  computed: {
    layout() {
      const layout = this.$route.meta.layout;
      if (layout === "DefaultLayout") return DefaultLayout;
      return null; // No layout for routes with `meta.layout: null`
    },
  },
};
</script>
