<template>
  <img :src="baseUrl + '/img/logorst.png'" alt="Logo RST" class="logo-image" />
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
  width: 75px;
  height: auto;
}
</style>