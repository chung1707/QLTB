export default {
    thumbnails(state){
        return state.thumbnails;
    },
    equipments(state){
        return state.equipments;
    },
    totalPrice(state){
        let sum = null;
        for (var i = 0; i < state.equipments.length; i++) {
            sum +=
                state.equipments[i].price *
                state.equipments[i].quantity;
        }
        return sum;
    },
    // cart
    equipmentInCart(state){
        return state.equipmentInCart;
    },
    totalPriceInCart(state){
        let sum = null;
            for (var i = 0; i < state.equipmentInCart.length; i++) {
                sum +=
                    state.equipmentInCart[i].pivot.price *
                    state.equipmentInCart[i].pivot.quantity;
            }
        return sum;
    },
    totalEquipment(state){
        let total = 0;
        for(let i = 0; i < state.equipmentInCart.length; i++){
            total += Number(state.equipmentInCart[i].pivot.quantity);
        }
        return Number(total);
    },
}
