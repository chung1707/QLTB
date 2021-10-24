<template>
    <div class="nav-item dropdown no-arrow mx-1 show">
        <a
            class="nav-link dropdown-toggle"
            href="#"
            id="alertsDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="true"
        >
            <i class="fas fa-shopping-cart fa-3x text-gray-300"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">{{
                totalEquipmentInSellCart
            }}</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div
            class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
            aria-labelledby="alertsDropdown"
        >
            <h6 class="dropdown-header">
                Sản phẩm chờ xuất
            </h6>
            <div v-for="item in sellCart" :key="item.id">
                <div
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                    style="position: relative;"
                >
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <a
                                style="text-decoration: none; color: black; cursor: pointer;"
                                :href="'/equipment/' + item.id"
                                class="font-weight-bold"
                                ><img
                                    style="max-width: 50px;"
                                    :src="
                                        '/storage/thumbnails/' + item.equipment.thumbnail
                                    "
                                />
                            </a>
                        </div>
                    </div>
                    <div>
                        <a
                            style="text-decoration: none; color: black; cursor: pointer;"
                            :href="'/equipment/' + item.equipment.id"
                            class="font-weight-bold"
                            >{{ item.equipment.name }}</a
                        >

                        <div class="text-black-500">
                            Số lượng: {{ item.pivot.quantity }}
                        </div>
                    </div>
                    <span
                        class="font-weight-bold"
                        style=" position: absolute;
                                cursor: pointer;
                                right: 10px;"
                        @click.prevent="deleteItemInSellCart(item)"
                        >X</span
                    >
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a
                    class="dropdown-item text-center small text-black-500"
                    href="/sell"
                    >Thanh lý thiết bị</a
                >
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters(["sellCart", "totalEquipmentInSellCart"])
    },
    methods: {
        ...mapActions(["getSellCart", "deleteItemInSellCart"])
    },
    mounted() {
        this.getSellCart();
    }
};
</script>

<style scoped></style>
