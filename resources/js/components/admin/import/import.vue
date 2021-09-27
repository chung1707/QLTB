<template>
    <div class="container-fluid">
        <div class="card-body">
            <div class="table-responsive">
                <div
                    id="dataTable_wrapper"
                    class="dataTables_wrapper dt-bootstrap4"
                >
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div
                                id="dataTable_filter"
                                class="dataTables_filter"
                            >
                                <label
                                    >Tìm kiếm:<input
                                        type="search"
                                        class="form-control form-control-sm"
                                        placeholder=""
                                        aria-controls="dataTable"
                                /></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                class="table table-bordered dataTable"
                                id="dataTable"
                                width="100%"
                                cellspacing="0"
                                role="grid"
                                aria-describedby="dataTable_info"
                                style="width: 100%;"
                            >
                                <thead>
                                    <tr role="row">
                                        <th
                                            class="sorting sorting_asc"
                                            aria-controls="dataTable"
                                            aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending"
                                            style="width: 194px;"
                                        >
                                            ID
                                        </th>
                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: 296px;"
                                        >
                                            Tên thiết bị
                                        </th>
                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            colspan="1"
                                            aria-label="Age: activate to sort column ascending"
                                            style="width: 141x;"
                                        >
                                            Số lượng
                                        </th>
                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            colspan="1"
                                            aria-label="Age: activate to sort column ascending"
                                            style="width: 141px;"
                                        >
                                            Giá trị
                                        </th>

                                        <th
                                            class="sorting"
                                            aria-controls="dataTable"
                                            colspan="3"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 50px;"
                                        >
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td class="sorting_1">1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>
                                            <a
                                                class="btn btn-primary btn-sm"
                                                href=""
                                                >Xem chi tiết</a
                                            >
                                        </td>
                                        <td>
                                            <a
                                                class="btn btn-primary btn-sm"
                                                href=""
                                                >Sửa</a
                                            >
                                        </td>
                                        <td class="table__content">
                                            <form action="  " method="post">
                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    type="submit"
                                                >
                                                    Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <div class="card">
                        <h5 class="success" v-if="success">
                            <i class="fas fa-check"></i> Thêm thành công
                        </h5>
                        <h5 class="text-center mb-4">Thêm thiết bị nhập</h5>
                        <form class="form-card">
                            <div class="row justify-content-between text-left">
                                <span class="inputErrors" v-if="error.name">{{
                                    error.name[0]
                                }}</span>
                                <div
                                    class="form-group col-sm-12 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >Tên thiết bị</label
                                    >
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        placeholder="Nhập tên thiết bị"
                                        v-model="equipment.name"
                                        :class="{ errorInput: error.name }"
                                    />
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <span
                                        class="inputErrors"
                                        v-if="error.price"
                                        >{{ error.price[0] }}</span
                                    >
                                    <label class="form-control-label px-3"
                                        >Giá thành</label
                                    >
                                    <input
                                        type="text"
                                        id="price"
                                        name="price"
                                        placeholder="Nhập giá thành"
                                        v-model="equipment.price"
                                        :class="{ errorInput: error.price }"
                                    />
                                </div>
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <span
                                        class="inputErrors"
                                        v-if="error.quantity"
                                        >{{ error.quantity[0] }}</span
                                    >
                                    <label class="form-control-label px-3"
                                        >Số lượng</label
                                    >
                                    <input
                                        type="number"
                                        id="name"
                                        name="quantity"
                                        placeholder="Nhập số lượng"
                                        v-model="equipment.quantity"
                                        :class="{ errorInput: error.name }"
                                    />
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <span
                                    class="inputErrors"
                                    v-if="error.suppler_id"
                                    >{{ error.suppler_id[0] }}</span
                                >
                                <div class="form-group">
                                    <label for="role">Nhà cung cấp</label>
                                    <select
                                        class="form-control"
                                        name="supplier_id"
                                        :class="{ errorInput: error.supplier_id }"
                                        v-model="equipment.supplier_id"
                                    >
                                        <option
                                        v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id"
                                        >
                                         {{ supplier.name }}  </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <span
                                    class="inputErrors"
                                    v-if="error.category_id"
                                    >{{ error.category_id[0] }}</span
                                >
                                <div class="form-group">
                                    <label for="role">Chọn thể loại</label>
                                    <select
                                        class="form-control"
                                        name="category_id"
                                        v-model="equipment.category_id"
                                        :class="{ errorInput: error.category_id }"

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
                            <div class="row justify-content-between text-left">
                                <span
                                    class="inputErrors"
                                    v-if="error.description"
                                    >{{ error.description[0] }}</span
                                >
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
                            </div>
                               <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-12 flex-column d-flex"
                                >
                                 <label class="form-control-label px-3"
                                        >Tải 2 của ảnh thiết bị</label
                                    >
                                    <dropzone-uploader></dropzone-uploader>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div
                                    class="form-group col-sm-6"
                                    style="margin-top: 5px;"
                                >
                                    <a
                                        href="/category"
                                        class="btn btn-block btn-primary"
                                        style="line-height: 30px;"
                                        >Hủy</a
                                    >
                                </div>
                                <div class="form-group col-sm-6">
                                    <button
                                        @click.prevent="addEquipment(this.equipment)"
                                        class="btn btn-block btn-primary"
                                    >
                                        Thêm danh mục
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    computed:{
        ...mapGetters(['thumbnails']),
    },
    data() {
        return {
            equipment: {
                 name: "",
                description: "",
                supplier_id: 1,
                category_id: 1,
                price: null,
                quantity: null,
            },
            suppliers: {},
            categories: {},
            error: {},
            success: false
        };
    },
    methods: {
        ...mapActions(['addEquipment']),
        getSuppliers() {
            axios.get("/api/suppliers").then(response => {
                this.suppliers = response.data.suppliers;
            });
        },
        getCategories(){
             axios.get("/api/categories").then(response => {
                this.categories = response.data.categories;
            });
        },
    },
    mounted(){
        this.getCategories();
        this.getSuppliers();
    }
};
</script>

<style></style>
