<script>
import AddUser from './components/AddUser.vue'
import UpdateUser from './components/UpdateUser.vue'

export default {
  components: { AddUser, UpdateUser },
  data() {
    return {
      loading: false,
      list: []
    }
  },
  mounted() {
    this.getList()
  },
  methods: {
    getList() {
      this.loading = true
      this.axios
        .get('/api/users')
        .then(response => (this.list = response.data))
        .finally(() => this.loading = false)
    },
    updateUser(user) {
      this.$refs.updateUser.showModal(user)
    },
    deleteUser(user) {
      this.axios
        .delete('/api/users/'+user.id)
        .then(() => (this.getList()))
        .catch(error => {
          alert(error.response.data.message)
        })
    },
  }
}
</script>

<template>
  <main class="container">
    <div class="card mt-5">
      <div class="card-header text-white bg-info d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">User Management</h5>
        <AddUser @refreshList="getList"/>
      </div>

      <table class="table table-striped table-hover m-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="loading">
            <td colspan="4" class="text-center">
              <div class="spinner-border text-info" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </td>
          </tr>
          <tr v-else v-for="(user, i) in list" :key="i">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <button @click="updateUser(user)" class="btn btn-sm btn-primary me-1">Edit</button>
              <button @click="deleteUser(user)" class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <UpdateUser @refreshList="getList" ref="updateUser"/>
  </main>
</template>
