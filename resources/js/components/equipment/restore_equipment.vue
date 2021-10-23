<template>
    <div style="align-items: center;">
        <div @click.prevent="show = true">
            <a class="btn btn-primary btn-sm" href="">Thu hồi sản phẩm</a>
        </div>
         <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Thành công
        </h5>
        <div class="col-sm-12 card restore_card" v-show="show">
            <h5 class="text-center mb-4">{{ item.equipment.name }}</h5>
            <h5 class="text-center mb-4" v-if="item.area">Đơn vị: {{ item.area.name}}</h5>
            <h5 class="text-center mb-4" v-else >Đơn vị: {{ item.room.room}}</h5>
            <form class="form-card" @submit.prevent="onSubmit">
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <label class="form-control-label px-3 text-center"
                            >Chọn tình trạng thiết bị</label
                        >
                        <select class="form-control" name="status" id="stauts" v-model="selectedStatus">
                            <option
                            value="0"
                            >
                                Trạng thái tốt
                            </option>
                            <option
                            value="1"
                            >
                                Sản phẩm không còn khả năng sử dụng
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <label class="form-control-label px-3 text-center"
                            >Ghi chú (thiết bị hư hỏng)</label
                        >
                        <textarea class="form-control" name="status" id="stauts" v-model="note">
                        </textarea>
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="input-group">
                        <div>
                            <button
                                style="min-width: 32px"
                                class=""
                                type="button"
                                @click="reduce"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <input
                            type="number"
                            style="text-align: center"
                            class="form-control  quantityInput"
                            v-model="quantity"
                            min="1"
                        />
                        <div>
                            <button
                                style="min-width: 32px"
                                class=""
                                type="button"
                                @click="increasing"
                            >
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center text-center">
                    <div>
                        <button class="btn btn-primary reload">
                            <span>Thu hồi</span><i class="icon-refresh"></i>
                        </button>
                        <button
                            class="btn btn-secondary"
                            @click.prevent="show = false"
                        >
                            <span>Huỷ</span><i class="icon-refresh"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            Object: true,
            required: true
        }
    },
    data() {
        return {
            show: false,
            quantity: this.item.quantity,
            selectedStatus: 0,
            note: null,
            success: false,
        };
    },
    methods: {
        increasing() {
            if (this.quantity < this.item.quantity) {
                this.quantity++;
            }
        },
        reduce() {
            if (1 < this.quantity) {
                this.quantity--;
            }
        },
        onSubmit() {
            var formData = new FormData();
            formData.append("state", this.selectedStatus);
            formData.append("equipment_id", this.item.equipment.id);
            formData.append("quantity", this.quantity);
            formData.append("area_id", this.item.area_id);
            formData.append("room_id", this.item.room_id);
            formData.append("usedItem_id", this.item.id);
            formData.append("note", this.note);
            axios.post('/restore_equipment', formData).then(response => {
                if(response.data.status == 201){
                    this.success = true;
                    window.location.reload();
                }
            });
        }
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        },
        quantity() {
            if (this.quantity > this.item.quantity) {
                this.quantity = this.item.quantity;
            }
            if (this.quantity < 1) {
                this.quantity = 1;
            }
        }
    }
};
</script>

<style>
.restore_card {
    position: absolute;
    z-index: 9999;
    right: 20px;
    max-width: 400px;
    top: 14px;
}
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
    max-width: 400px;
}
</style>
