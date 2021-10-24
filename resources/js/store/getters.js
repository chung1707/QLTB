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
    totalEquipment(state){
        let total = 0;
        for(let i = 0; i < state.equipmentInCart.length; i++){
            total += Number(state.equipmentInCart[i].pivot.quantity);
        }
        return Number(total);
    },

    //sell
    sellCart(state){
        return state.sellCart;
    },
    totalPriceInSellCart(state){
        let sum = null;
            for (var i = 0; i < state.sellCart.length; i++) {
                sum +=
                    state.sellCart[i].pivot.newPrice *
                    state.sellCart[i].pivot.quantity;
            }
        return Number(sum);
    },
    totalEquipmentInSellCart(state){
        let total = 0;
        for(let i = 0; i < state.sellCart.length; i++){
            total += Number(state.sellCart[i].pivot.quantity);
        }
        return Number(total);
    },
}
