<script setup>

defineProps(['pageStart', 'pageEnd', 'maxLength'])

const emit = defineEmits(['next', 'prev'])

const activateNext = () => {
  emit('next')
}


</script>

<template>

  <div class="inline-flex mt-3">

    <button
        @click="emit('prev')"
        type="button"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"
        :disabled="pageStart <= 0"
    >
      Anterior
    </button>

    <button
        @click="activateNext"
        type="button"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
        :disabled="pageEnd >= maxLength"
    >
      Siguiente
    </button>

  </div>

</template>
