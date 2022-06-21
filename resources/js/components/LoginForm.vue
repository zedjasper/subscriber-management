<template>
    <div v-if="errorMessage" class="alert alert-danger">{{errorMessage}}</div>
    <form action="/authenticate" method="post" @submit.prevent="submit">
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" v-model="fields.email" />
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" v-model="fields.password" />
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login" />
        </div>
        <div class="mt-2 alert alert-info" v-if="loading"><i class="mdi mdi-loading mdi-spin"></i>Please wait...</div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            fields: {},
            errorMessage: '',
            loading: false
        }
    },
    methods: {
        submit() {
            this.errorMessage = '';
            this.loading = true;
            axios.post('/authenticate', this.fields).then(response => {
                console.log(response.data);
                this.loading = false;
                this.errorMessage = '';
                window.location = response.data;
            }).catch(error => {
                this.loading = false;
                this.errorMessage = error.response.data;
            });
        },
    },
}
</script>