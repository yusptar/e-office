<template>
  <img :src="baseUrl + '/img/logo-rs.png'" alt="Logo RST" class="logo-image" />
</template>

<script>
export default {
  name: 'LogoImage',
  computed: {
    baseUrl() {
      return window.baseUrl; 
    },
  },
};
</script>

<style scoped>
.logo-image {
  width: 250px;
  height: auto;
}
</style>