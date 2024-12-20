<template>
  <img :src="baseUrl + '/img/logorst.png'" alt="Logo RST" class="logo-image" />
</template>

<script>
export default {
  name: 'LogoImage',
  data() {
    return {
      baseUrl: window.location.origin,
    };
  },
};
</script>

<style scoped>
.logo-image {
  width: 75px;
  height: auto;
}
</style>
