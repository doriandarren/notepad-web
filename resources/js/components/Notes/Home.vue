<script setup>

import { ref, computed, onMounted } from "vue"
import PaginateNote from "@/components/PaginateNote.vue"
import LoadingSpinner from "@/components/LoadingSpinner.vue";
import Create from "@/components/Notes/Create.vue";
import Edit from "@/components/Notes/Edit.vue";

import useNotes from '@/composables/notes'
import SearchFilter from "@/components/SearchFilter.vue";


const { notes, getNotes, destroyNote, storeNote, updateNote } = useNotes()


const isCreate = ref(false);
const isUpdate = ref(false);
const isViewList = ref(true);
const noteId = ref(0);


const loading = ref(true);
const noteXpage = 6;
const pageStart = ref(0);
const pageEnd = ref(noteXpage);



onMounted(async () => {
  setTimeout(()=>{
    getNotes()
    loading.value = false
  }, 1000);
});


//Pagination
const next = () => {
  pageStart.value = pageStart.value + noteXpage;
  pageEnd.value = pageEnd.value + noteXpage
}


const prev = () => {
  pageStart.value = pageStart.value - noteXpage;
  pageEnd.value = pageEnd.value - noteXpage
}


const maxlength = computed(() => notes.value.length);




// Delete
const deleteNote = async (id) => {
  if(!window.confirm('¿Estas seguro?')){
    return
  }
  await destroyNote(id)
  await getNotes()
}



//Store
const createNote = () => {
  isCreate.value = true
  isViewList.value = false
}
const cancelCreate = () => {
  isCreate.value = false
  isViewList.value = true
}

const saveNote = async (form) => {
  await storeNote({ ...form })
  await getNotes()
  isCreate.value = false
  isViewList.value = true
}





//Edit
const editNote = (id) => {
  isUpdate.value = true
  isViewList.value = false
  noteId.value = id
}

const cancelEdit = () => {
  isUpdate.value = false
  isViewList.value = true
}

const updateNoteForm = async (note) => {
  await updateNote(note.id, note)
  await getNotes()
  isUpdate.value = false
  isViewList.value = true
}






const processSearch = (text) =>{
  console.log(text.toLowerCase())

  // return notes.filter(place => {
  //   const regex = new RegExp(text, 'gi');
  //   return place.title.match(regex);
  // })
}


</script>



<template>

  <LoadingSpinner v-if="loading" />

  <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md" v-else>

    <div class="mb-4 mt-5">
      <div class="font-bold text-xl mb-2">
        CheckList Template
      </div>
    </div>






    <div v-if="isCreate">
      <Create
          @saveNote="saveNote"
          @cancelCreate="cancelCreate"
      />
    </div>


    <div v-if="isUpdate">
      <Edit
          :noteId="noteId"
          @cancelEdit="cancelEdit"
          @updateNoteForm="updateNoteForm"
      />
    </div>





<!--    <div class="text-right">-->
<!--      <SearchFilter-->
<!--          @processSearch="processSearch"-->
<!--      />-->
<!--    </div>-->


    <div v-if="isViewList">

      <div class="flex place-content-end mb-4 mt-5">
        <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md cursor-pointer" @click="createNote">
          <i class="bi bi-plus"></i>
        </div>
      </div>

      <div class="grid grid-cols-3 rounded bg-gray-100 p-10">
        <template v-for="item in notes.slice(pageStart, pageEnd)" :key="item.id">

          <div class="max-w-sm flex flex-col rounded-lg overflow-hidden bg-white shadow mb-5 ml-5">
            <!-- card cover -->
            <div class="flex justify-end pt-1 pr-5">
              <svg class="h-8 w-8 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <!-- end card cover -->

            <!-- card content -->
            <div class="flex-1 px-6 py-4">
              <div class="flex mb-2">
                <svg class="h-12 w-12 text-yellow-400 bg-yellow-300 rounded-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />  <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />  <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />  <line x1="11" y1="6" x2="20" y2="6" />  <line x1="11" y1="12" x2="20" y2="12" />  <line x1="11" y1="18" x2="20" y2="18" /></svg>
                <div class="text-lg font-light text-gray-500 mt-2 ml-3">CkeckList</div>
              </div>
              <div class="font-bold text-lg">{{ item.title }}</div>
              <p class="text-gray-700 text-base">
                {{ item.description }}
              </p>

            </div>
            <!-- end card content -->

            <!-- card footer -->
            <div class="px-6 py-4">
              <button
                  @click="editNote(item.id)"
                  class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg
              hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700
              dark:focus:ring-blue-800 text-decoration-none mr-2"
              >
                Editar
              </button>

              <button
                  @click="deleteNote(item.id)"
                  class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold
                            text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none
                            focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150
                            text-decoration-none"
              >
                Eliminar
              </button>
            </div>
            <!-- end card footer -->
          </div>



        </template>
      </div>


      <div class="text-right mt-5" v-if="isViewList">
        <PaginateNote
            class="mb-3"
            @next="next"
            @prev="prev"
            :maxLength="maxlength"
            :pageStart="pageStart"
            :pageEnd="pageEnd"
        />
      </div>

    </div>

  </div>

</template>


<style scoped>

</style>

