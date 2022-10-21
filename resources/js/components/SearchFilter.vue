<script setup>
import {ref} from "vue";

const emit = defineEmits(['processSearch'])

const searchFilter = ref('')


</script>


<template>

  <div>
    <input
        type="text"
        name="find"
        id="find"
        placeholder="Buscador"
        v-model="searchFilter"
        @keyup="emit('processSearch', searchFilter)"
    />
  </div>

</template>


<style scoped>

</style>
