<script setup>
import { reactive } from "vue";

const form = reactive({
  'title': '',
  'description': '',
})

const emit = defineEmits(['saveNote', 'cancelCreate'])

</script>


<template>
  <div class="flex items-center justify-center p-10 mt-5">
    <form class="space-y-6" @submit.prevent="emit('saveNote', form)">
      <div class="space-y-4 xl:w-96">
        <div>
          <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="title">
            Título*
          </label>
          <input
              v-model="form.title"
              type="text"
              id="title"
              required
              class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
          >
        </div>

        <div>

          <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="description">
            Descripción
          </label>

          <textarea
              v-model="form.description"
              type="text"
              name="description"
              id="description"
              required
              rows="8"
              class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
          >
              </textarea>

        </div>


        <button type="submit"
                class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg
              hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700
              dark:focus:ring-blue-800 text-decoration-none mr-2"
        >
          Guardar
        </button>

        <button
            @click="emit('cancelCreate')"
            class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold
                            text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none
                            focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150
                            text-decoration-none"
        >
          Cancelar
        </button>
      </div>

    </form>
  </div>

</template>


