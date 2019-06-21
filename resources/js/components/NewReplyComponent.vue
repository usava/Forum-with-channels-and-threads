<template>
    <div v-if="signedIn">
        <div class="form-group">
            <textarea class="form-control"
                      name="body" id="body"
                      cols="30"  rows="5"
                      placeholder="Have something to say?"
                      v-model="body"></textarea>
        </div>
        <button class="btn btn-primary"
                @click="addReply">Post</button>

    </div>
    <div v-else>
        <p class="text-center">
            Please <a href="/login">sign in </a>to participate in this discussion
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .then(response => {
                        this.body = '';

                        flash('Your reply has been posted.');
                        this.$emit('created', response.data);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
