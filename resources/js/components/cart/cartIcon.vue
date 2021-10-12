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
            <i class="fas fa-luggage-cart fa-3x text-gray-300"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">{{
                totalEquipment
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
            <div v-for="item in equipmentInCart" :key="item.id">
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
                                        '/storage/thumbnails/' + item.thumbnail
                                    "
                                />
                            </a>
                        </div>
                    </div>
                    <div>
                        <a
                            style="text-decoration: none; color: black; cursor: pointer;"
                            :href="'/equipment/' + item.id"
                            class="font-weight-bold"
                            >{{ item.name }}</a
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
                        @click.prevent="deleteEquipmentIncart(item)"
                        >X</span
                    >
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a
                    class="dropdown-item text-center small text-black-500"
                    href="/export"
                    >Xuất thiết bị</a
                >
                <a
                    class="dropdown-item text-center small text-black-500"
                    href="ss"
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
        ...mapGetters(["equipmentInCart", "totalEquipment"])
    },
    methods: {
        ...mapActions(["getListEquipment", "deleteEquipmentIncart"])
    },
    mounted() {
        this.getListEquipment();
    }
};
</script>

<style scoped></style>
