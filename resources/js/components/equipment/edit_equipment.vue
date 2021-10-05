<template>
    <div class="container-fluid px-1 py-5 mx-auto">
         <h5 class="success" v-if="success"> <i class="fas fa-check"></i> Sửa đổi thông tin thành công </h5>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <ValidationObserver v-slot="{ handleSubmit }">
                        <h5 class="text-center mb-4">
                            Sửa đổi thông tin thiết bị
                        </h5>
                        <form
                            class="form-card"
                            @submit.prevent="handleSubmit(onSubmit)"
                        >
                            <div class="row justify-content-between text-left">
                                <ValidationProvider
                                    rules="required|max:255"
                                    name="name"
                                    v-slot="{ errors }"
                                >
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                         <span class="error" v-if="error.name">{{ error.name[0] }}</span>
                                        <label class="form-control-label px-3"
                                            >Tên thiết bị</label
                                        >
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            placeholder="Nhập tên thiết bị"
                                            v-model="equipment.name"
                                            :class="{
                                                errorInput: error.name
                                            }"
                                        />
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div class="row justify-content-between text-left">
                                <ValidationProvider
                                    rules="required|max:255|min:7"
                                    name="device_code"
                                    v-slot="{ errors }"
                                >
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                         <span class="error" v-if="error.device_code">{{ error.device_code[0] }}</span>
                                        <label class="form-control-label px-3"
                                            >Mã thiết bị</label
                                        >
                                        <input
                                            type="text"
                                            id="name"
                                            name="device_code"
                                            placeholder="Nhập mã thiết bị"
                                            v-model="equipment.device_code"
                                            :class="{
                                                errorInput: error.device_code
                                            }"
                                        />
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <ValidationProvider
                                        rules="required|quantityValid|numeric"
                                        name="price"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                         <span class="error" v-if="error.price">{{ error.price[0] }}</span>
                                        <label class="form-control-label px-3"
                                            >Giá thành</label
                                        >
                                        <input
                                            type="text"
                                            id="price"
                                            :min="1"
                                            name="price"
                                            placeholder="Nhập giá thành (VNĐ)"
                                            v-model="equipment.price"
                                            :class="{
                                                errorInput: error.price
                                            }"
                                        />
                                    </ValidationProvider>
                                </div>

                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <ValidationProvider
                                        rules="required|numeric|quantityValid:1"
                                        name="quantity"
                                        v-slot="{ errors }"
                                    >
                                        <span class="inputErrors">{{
                                            errors[0]
                                        }}</span>
                                         <span class="error" v-if="error.quantity">{{ error.quantity[0] }}</span>
                                        <label class="form-control-label px-3"
                                            >Số lượng</label
                                        >
                                        <input
                                            type="number"
                                            id="name"
                                            :min="1"
                                            name="quantity"
                                            placeholder="Nhập số lượng"
                                            v-model="equipment.quantity"
                                            :class="{
                                                errorInput: error.name
                                            }"
                                        />
                                    </ValidationProvider>
                                </div>
                            </div>
                            <div
                                class="form-group col-sm-12 flex-column d-flex text-left"
                            >
                                <ValidationProvider
                                    rules="required"
                                    name="supplier"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <span class="error" v-if="error.supplier_id">{{ error.supplier_id[0] }}</span>
                                    <div class="form-group">
                                        <label for="role">Nhà cung cấp</label>
                                        <select
                                            class="form-control"
                                            name="supplier_id"
                                            :class="{
                                                errorInput: error.supplier_id
                                            }"
                                            v-model="equipment.supplier_id"
                                        >
                                            <option
                                                v-for="supplier in suppliers"
                                                :key="supplier.id"
                                                :value="supplier.id"
                                            >
                                                {{ supplier.name }}
                                            </option>
                                        </select>
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div
                                class="form-group col-sm-12 flex-column d-flex text-left"
                            >
                                <ValidationProvider
                                    rules="required"
                                    name="category"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <span class="error" v-if="error.category_id">{{ error.category_id[0] }}</span>
                                    <div class="form-group">
                                        <label for="role">Chọn thể loại</label>
                                        <select
                                            class="form-control"
                                            name="category_id"
                                            v-model="equipment.category_id"
                                            :class="{
                                                errorInput: error.category_id
                                            }"
                                        >
                                            <option
                                                v-for="category in categories"
                                                :key="category.id"
                                                :value="category.id"
                                                >{{ category.name }}</option
                                            >
                                        </select>
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div
                                class="form-group justify-content-between text-left"
                            >
                                <ValidationProvider
                                    rules=""
                                    name="description"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <span class="error" v-if="error.description">{{ error.description[0] }}</span>
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex"
                                    >
                                        <label class="form-control-label px-3"
                                            >Mô tả</label
                                        >
                                        <textarea
                                            rows="5"
                                            cols="20"
                                            type="text"
                                            id="description"
                                            name="description"
                                            v-model="equipment.description"
                                            :class="{
                                                errorInput: error.description
                                            }"
                                        ></textarea>
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div
                                class="form-group justify-content-between "
                            > <label class="form-control-label px-3"
                                            >Ảnh của thiết bị</label
                                        >
                                <img
                                    class="img-fluid"
                                    style="width: 200px;"
                                    :src="
                                        '/storage/thumbnails/' +
                                            equipment.thumbnail
                                    "
                                    alt="Ảnh sản phẩm"
                                />
                            </div>
                            <div
                                class="form-group justify-content-between text-left"
                            >
                                <ValidationProvider
                                    rules="image"
                                    name="description"
                                    v-slot="{ errors }"
                                >
                                    <span class="inputErrors">{{
                                        errors[0]
                                    }}</span>
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex"
                                    >
                                        <label class="form-control-label px-3"
                                            >Tải 1 ảnh mới cho thiết bị</label
                                        >
                                        <dropzone-uploader></dropzone-uploader>
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div class="row justify-content-end">
                                <div
                                    class="form-group col-sm-6"
                                    style="margin-top: 5px;"
                                >
                                    <a
                                        :href="'/equipment/' + equipment.id"
                                        class="btn btn-block btn-primary"
                                        style="line-height: 30px;"
                                        >Hủy</a
                                    >
                                </div>
                                <div class="form-group col-sm-6">
                                    <button class="btn btn-block btn-primary">
                                        Sửa đổi thông tin
                                    </button>
                                </div>
                            </div>
                        </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(['thumbnails']),
    },
    props: {
        equipment: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            suppliers: {},
            categories: {},
            error: {},
            success: false
        };
    },
    methods: {
        onSubmit() {
            var formData = new FormData();
            formData.append("_method", "put");
            formData.append("name", this.equipment.name);
            formData.append("device_code", this.equipment.device_code);
            formData.append("quantity", this.equipment.quantity);
            formData.append("price", this.equipment.price);
            formData.append("supplier_id", this.equipment.supplier_id);
            formData.append("category_id", this.equipment.category_id);
            formData.append("description", this.equipment.description);
            formData.append("thumbnail", this.equipment.thumbnail);
            formData.append("thumbnails", this.thumbnails);
            axios
                .post("/equipment/" + this.equipment.id, formData)
                .then(() => {
                    this.success = true;
                    this.error = {};
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
                });
        },
        getSuppliers() {
            axios.get("/api/suppliers").then(response => {
                this.suppliers = response.data.suppliers;
            });
        },
        getCategories() {
            axios.get("/api/categories").then(response => {
                this.categories = response.data.categories;
            });
        }
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        }
    },
    mounted() {
        this.getCategories();
        this.getSuppliers();
    }
};
</script>

<style scoped>
.inputErrors {
    color: red;
    display: block;
}
.success {
    color: green;
    padding: 20px;
    background-color: rgba(0, 255, 0, 0.3);
    text-align: center;
    z-index: 2;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
.errorInput {
    border-color: red;
}
</style>
