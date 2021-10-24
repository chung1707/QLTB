<template>
    <div class="row">
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thành công
        </h5>
        <span class="error" v-if="error">
            <i class="fas fa-times-octagon"></i> Bạn chưa nhập đầy đủ giá cả cho
            các thiết bị!
        </span>
        <div class="row" v-if="Object.keys(sellCart).length === 0">
            <div class="card mb-4" style="margin: 0px auto;">
                <div class="card-header">
                    Thanh lý
                </div>
                <div class="card-body">
                    Bạn chưa chọn sản phẩm nào. Hãy chọn sản phẩm ngay!
                    <a class="btn btn-primary" href="/deleted_equipment"
                        >Chọn sản phẩm</a
                    >
                </div>
            </div>
        </div>
        <div class="container" v-else>
            <div class="card mb-4" style="margin: 0px auto;     padding: 0;">
                <div class="card-header">
                    Danh sách sản phẩm thanh lý
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
                                class="sorting"
                                aria-controls="dataTable"
                                aria-label="Position: activate to sort column ascending"
                            >
                                Tên thiết bị
                            </th>
                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="1"
                                aria-label="Age: activate to sort column ascending"
                            >
                                Số lượng
                            </th>
                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="1"
                                aria-label="Age: activate to sort column ascending"
                                style="width: 200px;"
                            >
                                Giá cũ (VNĐ)
                            </th>
                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="1"
                                aria-label="Age: activate to sort column ascending"
                            >
                                Giá mới (VNĐ)
                            </th>
                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="1"
                                aria-label="Age: activate to sort column ascending"
                            >
                                Tổng giá (VNĐ)
                            </th>
                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="1"
                                aria-label="Age: activate to sort column ascending"
                            >
                                Ảnh
                            </th>

                            <th
                                class="sorting"
                                aria-controls="dataTable"
                                colspan="2"
                                aria-label="Office: activate to sort column ascending"
                                style="width: 30px;"
                            >
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd" v-for="item in sellCart" :key="item.id">
                            <td>{{ item.equipment.name }}</td>
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
                            <td>{{ item.equipment.price }}</td>
                            <td>
                                <div
                                    class="product-details-quantity"
                                    style="margin-right: 25px;"
                                >
                                    <div class="input-group  input-spinner">
                                        <input
                                            type="number"
                                            @change="checkPrice(item)"
                                            style="text-align: center"
                                            class="form-control  quantityInput"
                                            v-model="item.pivot.newPrice"
                                            min="1"
                                        />
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ item.pivot.quantity * item.pivot.newPrice }}
                            </td>
                            <td>
                                <a :href="'/equipment/' + item.id">
                                    <img
                                        style="max-width: 80px;"
                                        :src="
                                            '/storage/thumbnails/' +
                                                item.equipment.thumbnail
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
                <div class="text-right" v-show="totalPriceInSellCart">
                    <h4>
                        Tổng hóa đơn:
                        <span style="color: red;"
                            >{{ totalPriceInSellCart }} VNĐ</span
                        >
                    </h4>
                </div>
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
                            @click.prevent="onSell"
                        >
                            <span>Thanh lý thiết bị</span
                            ><i class="icon-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="container-fluid px-1 py-5 mx-auto" v-if="sell">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="card">
                            <ValidationObserver v-slot="{ handleSubmit }">
                                <h5 class="text-center mb-4">
                                    Thông tin thanh lý
                                </h5>
                                <form
                                    class="form-card"
                                    @submit.prevent="handleSubmit(exportToRoom)"
                                >
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex text-left"
                                    >
                                        <ValidationProvider
                                            rules="required|max:255"
                                            name="name"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <div class="form-group">
                                                <label for="name"
                                                    >Tên khách hàng</label
                                                >
                                                <input
                                                    class="form-control"
                                                    name="name"
                                                    v-model="name"
                                                    id="name"
                                                />
                                            </div>
                                        </ValidationProvider>
                                    </div>
                                    <div
                                        class="form-group col-sm-12 flex-column d-flex text-left"
                                    >
                                        <ValidationProvider
                                            rules="required|max:255|numeric|min:9"
                                            name="phone"
                                            v-slot="{ errors }"
                                        >
                                            <span class="inputErrors">{{
                                                errors[0]
                                            }}</span>
                                            <div class="form-group">
                                                <label for="name"
                                                    >Số điện thoại</label
                                                >
                                                <input
                                                    class="form-control"
                                                    name="phone"
                                                    v-model="phone"
                                                    id="phone"
                                                />
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
                                                @click.prevent="onSubmit"
                                            >
                                                Thanh lý
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
            sell: false,
            name: null,
            phone: null,
            sellBill: {
                items: null,
                client: null,
                phone: null,
                totalPrice: null,
            },
            error: false,
            success: false
        };
    },
    computed: {
        ...mapGetters(["sellCart", "totalPriceInSellCart"])
    },
    methods: {
        ...mapActions([
            "getSellCart",
            "deleteItemInSellCart",
            "updateQtySellCart",
            "clearSellCart",
            "updateNewPriceSellCart"
        ]),
        // kiem soat so luong
        increasing(item) {
            if (item.pivot.quantity < item.quantity) {
                item.pivot.quantity++;
                this.updateQtySellCart(item);
            }
        },
        reduce(item) {
            if (1 < item.pivot.quantity) {
                item.pivot.quantity--;
                this.updateQtySellCart(item);
            }
        },
        check(item) {
            if (item.pivot.quantity > item.quantity) {
                item.pivot.quantity = item.quantity;
            }
            if (item.pivot.quantity < 1) {
                item.pivot.quantity = 1;
            }
            this.updateQtySellCart(item);
        },
        // cap nhap gio hang
        reloadCart() {
            this.getSellCart();
            this.reload = true;
        },
        // Kiem soat gia moi vaf cap nhap
        checkPrice(item) {
            if (item.pivot.newPrice < 1) {
                item.pivot.newPrice = 1;
            }
            this.updateNewPriceSellCart(item);
        },
        onSell() {
            let itemIncart = this.sellCart.find(item => {
                return item.pivot.newPrice === null;
            });
            if (itemIncart) {
                this.error = true;
                return (this.sell = false);
            } else {
                this.error = false;
                return (this.sell = true);
            }
        },
        onSubmit(){
            this.sellBill.client = this.name;
            this.sellBill.phone = this.phone;
            this.sellBill.totalPrice = this.totalPriceInSellCart;
            this.sellBill.items = this.sellCart;
            axios.post("/create_sell_bill",{'sellBill': this.sellBill}).then((response)=> {
                if(response.data.status == 201){
                    this.clearSellCart();
                    this.success = true;
                    window.location.href = "/sell_bill/show/" + response.data.bill_id;
                }
        });
        },
    },
    beforeMount() {
        this.getSellCart();
    },
    watch: {
        reload() {
            setTimeout(() => (this.reload = false), 1000);
        },
        success() {
            setTimeout(() => (this.success = false), 1500);
        },
        error(){
            setTimeout(() => (this.error = false), 3000);
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
.error {
    color: rgb(241 10 0);
    padding: 20px;
    background-color: rgb(231 165 165 / 30%);
    text-align: center;
    z-index: 2;
    position: fixed;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    font-size: 20px;
    transform: translate(-50%, -50%);
}
/*
emptycart style */
</style>
