import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useCompanies() {
    const note = ref([])
    const notes = ref([])

    const errors = ref('')
    const router = useRouter()

    const getNotes = async () => {
        let response = await axios.get('http://localhost:8000/api/note/list')
        notes.value = response.data.data
    }

    const getNote = async (id) => {
        let response = await axios.get(`http://localhost:8000/api/note/show/${id}`)
        note.value = response.data.data
    }


    const storeNote = async (data) => {
        errors.value = ''
        try {
            await axios.post('http://localhost:8000/api/note/store', data)
            await router.push({ name: 'note.index' })
        } catch (e) {
            // if (e.response.status_code === 422) {
            //     for (const key in e.response.data.errors) {
            //         errors.value = e.response.data.errors
            //     }
            // }
        }

    }

    const updateNote = async (id, note) => {
        errors.value = ''
        try {
            await axios.put(`http://localhost:8000/api/note/update/${id}`, note)
            await router.push({ name: 'note.index' })
        } catch (e) {
            console.log(e)
            // if (e.response.status === 422) {
            //     for (const key in e.response.data.errors) {
            //         errors.value = e.response.data.errors
            //     }
            // }
        }
    }


    const destroyNote = async (id) => {
        await axios.delete('http://localhost:8000/api/note/destroy/' + id)
    }

    return {
        errors,
        note,
        notes,
        getNote,
        getNotes,
        storeNote,
        updateNote,
        destroyNote
    }
}
