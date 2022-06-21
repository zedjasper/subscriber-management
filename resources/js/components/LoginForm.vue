<template>
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
    </form>
</template>
<script>
export default {
    data() {
        return {
            fields: {}
        }
    },
    methods: {
        submit() {
            axios.post('/authenticate', this.fields).then(response => {
                window.location = response.data.redirect_url;
            }).catch(error => {
                console.log(error);
            });
        },
    },
}
</script>