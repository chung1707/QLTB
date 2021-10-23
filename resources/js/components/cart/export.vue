<template>
    <div class="row">
         <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thành công
        </h5>
        <div class="row" v-if="Object.keys(equipmentInCart).length === 0">
            <div class="card mb-4" style="margin: 0px auto;">
                <div class="card-header">
                    Xuất kho
                </div>
                <div class="card-body">
                    Bạn chưa chọn sản phẩm nào. Hãy chọn sản phẩm ngay!
                    <a class="btn btn-primary" href="/equipment">Chọn sản phẩm</a>
                </div>
            </div>
        </div>
        <div class="container" v-else>
            <div class="card mb-4" style="margin: 0px auto;     padding: 0;">
                <div class="card-header">
                    Danh sách sản phẩm xuất kho
                </div>
            </div>
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
                                Mã thiết bị
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
                                Ảnh
                            </th>

                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="2"
                                aria-label="Office: activate to sort column ascending"
                                style="width: 50px;"
                            >
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="odd"
                            v-for="item in equipmentInCart"
                            :key="item.id"
                        >
                            <td class="sorting_1">{{ item.device_code }}</td>
                            <td>{{ item.name }}</td>
                            <td>
                                <div
                                    class="product-details-quantity"
                                    style="margin-right: 25px;"
                                >
                                    <div class="input-group  input-spinner">
                                        <div>
                                            <button
                                                style="min-width: 32px"
                                                class=""
                                                type="button"
                                                @click="reduce(item)"
                                            >
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input
                                            type="number"
                                            @change="check(item)"
                                            style="text-align: center"
                                            class="form-control  quantityInput"
                                            v-model="item.pivot.quantity"
                                            min="1"
                                        />
                                        <div>
                                            <button
                                                style="min-width: 32px"
                                                class=""
                                                type="button"
                                                @click="increasing(item)"
                                            >
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .product-details-quantity -->
                            </td>
                            <td>
                                <a :href="'/equipment/' + item.id">
                                    <img
                                        style="max-width: 80px;"
                                        :src="
                                            '/storage/thumbnails/' +
                                                item.thumbnail
                                        "
                                    />
                                </a>
                            </td>
                            <td>
                                Xóa
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <div>
                        <button
                            class="btn btn-primary reload"
                            @click.prevent="reloadCart()"
                        >
                            <span>Cập nhập giỏ</span
                            ><i class="icon-refresh"></i>
                        </button>
                        <span v-show="reload" class="successLoad"
                            ><i class="fas fa-check"></i>thành công</span
                        >
                    </div>
                    <div>
                        <button
                            class="btn btn-primary reload"
                            @click.prevent="pickRoom = true; pickArea = false"
                        >
                            <span>Xuất kho cho phòng</span><i class="icon-refresh"></i>
                        </button>
                        <button
                            class="btn btn-primary reload"
                            @click.prevent="pickArea = true; pickRoom = false"
                        >
                            <span>Xuất kho cho khu vực</span><i class="icon-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="container-fluid px-1 py-5 mx-auto" v-if="pickArea">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="card">
                            <ValidationObserver v-slot="{ handleSubmit }">
                                <h5 class="text-center mb-4">
                                    Chọn khu vực
                                </h5>
                                <form
                                    class="form-card"
                                    @submit.prevent="handleSubmit(exportToArea)"
                                >
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex text-left"
                                    >
                                        <ValidationProvider
                                            rules="required"
                                            name="area_id"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <div class="form-group">
                                                <label for="role"
                                                    >Chọn khu vực</label
                                                >
                                                <select
                                                    class="form-control"
                                                    name="area_id"
                                                    v-model="area_id"
                                                >
                                                     <option
                                                        value="null"
                                                    >
                                                        Chọn địa điểm
                                                    </option>
                                                    <option
                                                        v-for="area in areas"
                                                        :key="area.id"
                                                        :value="area.id"
                                                    >
                                                        {{ area.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </ValidationProvider>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group col-sm-6">
                                            <button
                                                class="btn btn-block btn-primary"
                                                @click.prevent="
                                                    pickArea = false
                                                "
                                            >
                                                Hủy
                                            </button>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <button
                                                class="btn btn-block btn-primary"
                                            >
                                                Xuất kho
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </ValidationObserver>
                        </div>
                    </div>
                </div>
            </div>
             <div class="container-fluid px-1 py-5 mx-auto" v-if="pickRoom">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="card">
                            <ValidationObserver v-slot="{ handleSubmit }">
                                <h5 class="text-center mb-4">
                                    Chọn phòng
                                </h5>
                                <form
                                    class="form-card"
                                    @submit.prevent="handleSubmit(exportToRoom)"
                                >
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex text-left"
                                    >
                                        <ValidationProvider
                                            rules="required"
                                            name="room_id"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <div class="form-group">
                                                <label for="role"
                                                    >Chọn phòng</label
                                                >
                                                <select
                                                    class="form-control"
                                                    name="room_id"
                                                    v-model="room_id"
                                                >
                                                    <option
                                                        value="null"
                                                    >
                                                        Chọn phòng
                                                    </option>
                                                    <option
                                                        v-for="room in rooms"
                                                        :key="room.id"
                                                        :value="room.id"
                                                    >
                                                        {{ room.room }}
                                                    </option>
                                                </select>
                                            </div>
                                        </ValidationProvider>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group col-sm-6">
                                            <button
                                                class="btn btn-block btn-primary"
                                                @click.prevent="
                                                    pickRoom = false
                                                "
                                            >
                                                Hủy
                                            </button>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <button
                                                class="btn btn-block btn-primary"
                                            >
                                                Xuất kho
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </ValidationObserver>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            reload: false,
            pickArea: false,
            pickRoom: false,
            areas: [],
            rooms: [],
            area_id: null,
            room_id: null,
            exportBill: {
                items: null,
                area_id: null,
                room_id: null,
            },
            success: false,
        };
    },
    computed: {
        ...mapGetters(["equipmentInCart"])
    },
    methods: {
        ...mapActions([
            "getListEquipment",
            "deleteEquipmentIncart",
            "updateQty",
            "clearCart"
        ]),
        increasing(item) {
            if (item.pivot.quantity < item.quantity) {
                item.pivot.quantity++;
                this.updateQty(item);
            }
        },
        reduce(item) {
            if (1 < item.pivot.quantity) {
                item.pivot.quantity--;
                this.updateQty(item);
            }
        },
        check(item) {
            if (item.pivot.quantity > item.quantity) {
                item.pivot.quantity = item.quantity;
            }
            if (item.pivot.quantity < 1) {
                item.pivot.quantity = 1;
            }
            this.updateQty(item);
        },
        reloadCart() {
            this.getListEquipment();
            this.reload = true;
        },
        getAreas(){
            axios.get('api/info/areas').then(response => {
                this.areas = response.data.areas;
            });
        },
        getRooms(){
            axios.get('api/info/rooms').then(response => {
                this.rooms = response.data.rooms;
            });
        },
        exportToArea(){
            this.exportBill.items =  this.equipmentInCart;
            this.exportBill.area_id =  this.area_id;
            this.exportBill.room_id = null;
            axios.post("/export",{'exportBill': this.exportBill}).then((response)=> {
            if(response.data.status == 201){
                this.success = true;
                this.clearCart();
            }
        });
        },
        exportToRoom(){
            this.exportBill.items =  this.equipmentInCart;
            this.exportBill.room_id = this.room_id;
            this.exportBill.area_id = null;
            axios.post("/export_to_room",{'exportBill': this.exportBill}).then((response)=> {
            if(response.data.status == 201){
                this.success = true;
                this.clearCart();
            }
        });
        },
    },
    beforeMount() {
        this.getListEquipment();
        this.getAreas();
        this.getRooms();
    },
    watch: {
        reload() {
            setTimeout(() => (this.reload = false), 1000);
        },
        success() {
            setTimeout(() => (this.success = false), 1500);
        },
    }
};
</script>

<style scoped>
.contentCart {
    justify-content: space-around !important;
}
.quantityInput::-webkit-outer-spin-button,
.quantityInput::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
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
    max-width: 300px;
}
.successLoad {
    color: green;
    background-color: rgba(0, 255, 0, 0.3);
    text-align: center;
    z-index: 2;
    padding: 10px 20px;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}

/*
emptycart style */
</style>
