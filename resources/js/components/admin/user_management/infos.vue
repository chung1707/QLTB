<template>
    <div class="card">
        <h5 class="success" v-if="success">
            <i class="fas fa-check"></i> Sửa đổi thông tin thành công
        </h5>
        <h5 class="text-center mb-4">Thông tin người dùng</h5>
        <form class="form-card">
            <div class="row justify-content-between text-left">
                <span class="inputErrors" v-if="error.name">{{ error.name[0] }}</span>
                <div class="form-group col-sm-12 flex-column d-flex">
                    <label class="form-control-label px-3">Họ tên</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Nhập họ tên"
                        v-model="user.name"
                        :class="{ errorInput: error.name }"
                    />
                </div>
            </div>
            <div class="row justify-content-between text-left">
                <span class="inputErrors" v-if="error.username">{{ error.username[0] }}</span>
                <div class="form-group col-sm-12 flex-column d-flex">
                    <label class="form-control-label px-3">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder=""
                        v-model="user.username"
                        :class="{ errorInput: error.username }"
                    />
                </div>

                <div class="row justify-content-between text-left">
                    <span class="inputErrors" v-if="error.employee_id">{{ error.employee_id[0] }}</span>
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <label class="form-control-label px-3"
                            >Mã nhân viên</label
                        >
                        <input
                            type="text"
                            id="employee_id"
                            name="employee_id"
                            placeholder=""
                            v-model="user.employee_id"
                            :class="{ errorInput: error.employee_id }"
                        />
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <span class="inputErrors" v-if="error.role_id">{{ error.role_id[0] }}</span>
                    <div class="form-group">
                        <label for="role">Quyền tài khoản</label>
                        <select class="form-control"  id="role" v-model="role_id">
                            <option
                            v-for="role in roles" :key="role.id"
                             :value="role.id" >{{role.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group col-sm-6" style="margin-top: 5px;">
                        <a
                            href="/users"
                            class="btn btn-block btn-primary"
                            style="line-height: 30px;"
                            >Hủy</a
                        >
                    </div>
                    <div class="form-group col-sm-6">
                        <button @click.prevent="updateInfos()" class="btn btn-block btn-primary">
                            Cập nhập
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            role_id: null,
            error: {},
            success: false
        };
    },

    props: {
        user: {
            type: Object
        },
        roles: {
            type: Object
        }
    },
    methods: {
        updateInfos() {
            var formData = new FormData();
            formData.append("_method", "put");
            formData.append("name", this.user.name);
            formData.append("username", this.user.username);
            formData.append("employee_id", this.user.empolyee_id);
            formData.append("role_id", this.role_id);
            axios
                .post("/users/" + this.user.id, formData)
                .then(() => {
                    this.success = true;
                    this.error = {};
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                    this.success = false;
                });
        }
    },
    watch: {
        success() {
            setTimeout(() => (this.success = false), 1500);
        }
    },
    mounted() {
        this.role_id = this.user.role_id;
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
