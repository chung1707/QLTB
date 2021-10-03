<template>
    <div class="form-group col-sm-12 flex-column d-flex text-left">
        <div class="form-group">
            <label for="category">Chọn thể loại</label>
            <select
                class="form-control"
                name="category_id"
                v-model="category_id"
            >
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                    >{{ category.name }}</option
                >
            </select>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            categories: [],
            category_id: 1,
        }
    },
    methods: {
        getCategories() {
            axios.get("/api/categories").then(response => {
                this.categories = response.data.categories;
            });
        },
    },
    mounted() {
        this.getCategories();
    },

};
</script>

<style></style>
