<template>
    <nav aria-label="Page navigation example" class="mt-4" v-if="shouldPaginate">
        <ul class="pagination">
            <li class="page-item" v-show="prevUrl" @click.prevent="page--"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item" v-for="pageNumber in totalPages" @click.prevent="page = pageNumber">
                <a class="page-link" href="#" v-text="pageNumber"></a>
            </li>
            <li class="page-item" v-show="nextUrl" @click.prevent="page++"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                totalPages: 1,
                prevUrl: false,
                nextUrl: false,
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.totalPages = this.dataSet.total;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },
            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! ( this.prevUrl || this.nextUrl);
            },

        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },
            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>

<style scoped>

</style>
