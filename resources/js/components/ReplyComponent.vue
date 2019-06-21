<template>
    <div :id="'reply-'+id" class="card">
        <div class="card-header">
            <div class="level d-flex align-items-center">
                <h5 class="flex-grow-1">
                    <a :href="'profiles/'+data.owner.name" v-text="data.owner.name"></a>
                    said <span v-text="ago">{{ data.created_at }}</span>
                </h5>


                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer level" v-if="canUpdate">
            <button class="btn btn-warning btn-sm mr-2" @click="editing =! editing">Edit</button>
            <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
        </div>
    </div>
</template>

<script>
    import Favorite from './FavoriteComponent.vue';
    import moment from 'moment';
    export default {
        props: ['data'],
        components: {Favorite},
        data() {
            return {
                editing: false,
                body: this.data.body,
                id: this.data.id
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
            canUpdate() {
                return this.authorize(user => this.data.user_id == window.App.user.id);
            },
            ago() {
                return moment(this.data.created_at).fromNow();
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Reply updated');
            },
            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
            }
        }
    }
</script>
