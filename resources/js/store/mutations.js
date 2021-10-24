export default {
    setThumbnailNames(state, thumbnails){
        state.thumbnails = thumbnails;
    },
    resetThumbnailNames(state){
        state.thumbnails = [];
    },
    addEquipment(state, equipment){
        state.equipments.push(equipment);
    },
    removeEquipment(state,equipment){
        let index = state.equipments.indexOf(equipment);
        state.equipments.splice(index, 1);
    },
    setEquipments(state, equipments){
        state.equipments = equipments;
    },

    //cart
    setEquipmentInCart(state, equipments){
        state.equipmentInCart = equipments;
    },
    addToCart(state, equipment){
        let qty  = 1;
        let itemIncart = state.equipmentInCart.find(item => {
            return item.id === equipment.id;
        });
        if(itemIncart){
            if(itemIncart.pivot.quantity + qty > itemIncart.quantity){
                itemIncart.pivot.quantity = itemIncart.quantity;
                return;
            }
            itemIncart.pivot.quantity += qty;
            return;
        }
        equipment['pivot'] = {'quantity':qty,'price': null};
        state.equipmentInCart.push(equipment);
    },
    deleteEquipment(state,equipment){
        let index = state.equipmentInCart.indexOf(equipment);
        state.equipmentInCart.splice(index, 1);
    },

    //sell
    setSellCart(state, equipments){
        state.sellCart = equipments;
    },
    addToSellCart(state, equipment){
        let qty  = 1;
        let itemIncart = state.sellCart.find(item => {
            return item.id === equipment.id;
        });
        if(itemIncart){
            if(itemIncart.pivot.quantity + qty > itemIncart.quantity){
                itemIncart.pivot.quantity = itemIncart.quantity;
                return;
            }
            itemIncart.pivot.quantity += qty;
            return;
        }
        equipment['pivot'] = {'quantity':qty,'newPrice': null};
        state.sellCart.push(equipment);
    },
    deleteItemInSellCart(state,equipment){
        let index = state.sellCart.indexOf(equipment);
        state.sellCart.splice(index, 1);
    },

}
