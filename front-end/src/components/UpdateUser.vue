<script>
import { Modal } from 'bootstrap'
export default {
  data() {
    return {
      id: 0,
      name: '',
      email: '',
      myModal: null
    }
  },
  methods: {
    showModal(user) {
      this.id = user.id
      this.name = user.name
      this.email = user.email
      this.myModal = new Modal(document.getElementById('updateModal'), {})
      this.myModal.show()
    },
    submit() {
      this.axios
      .put('/api/users/'+this.id, { name: this.name, email: this.email })
      .then(() => {
        this.$emit('refreshList')
        this.clearForm()
      })
      .catch(error => {
        alert(error.response.data.message)
      })
    },
    clearForm() {
      this.id = 0
      this.name = ''
      this.email = ''
      this.myModal.hide()
    }
  }
}
</script>

<template>
  <div>
    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Update User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">            
              <div class="mb-3">
                <input v-model="name" class="form-control" type="text" placeholder="Name">
              </div>
              <div>
                <input v-model="email" class="form-control" type="text" placeholder="Email">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" @click="clearForm">Cancel</button>
            <button type="button" class="btn btn-sm btn-primary" @click="submit">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>