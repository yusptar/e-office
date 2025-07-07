<template>
  <img :src="baseUrl + '/img/logo-rs.png'" :alt="alt" :class="imgClass" />
</template>

<script>
export default {
  name: 'LogoImage',
  props: {
    alt: {
      type: String,
      default: 'Logo RST'
    },
    imgClass: {
      type: String,
      default: 'w-16 h-auto'
    }
  },
  computed: {
    baseUrl() {
      return window.baseUrl;
    }
  }
};
</script>
