const axios = require('axios');

export default {
    setThumbnails(context, thumbnails){
        context.commit('setThumbnailNames',thumbnails);
    },
    addEquipment(context, equipment){
        context.commit('addEquipment',equipment);
        context.commit('setThumbnailNames',[]);
    },
    removeEquipment(context, equipment){
        context.commit('removeEquipment',equipment);
    },
    import(context,equipments_import){
        let equipments = equipments_import[0];
        let bill = equipments_import;
        equipments.forEach(equipment => equipment.supplier_id = equipments_import[1]);
        axios.post('/equipment',{'equipments': equipments, 'bill': bill}).then((response) =>{
            if(response.data.status == 201){
                context.commit('setEquipments',[]);
            }
        });
    },
    // cart
    getListEquipment(context){
        axios.get("/get_cart").then(response =>{
            context.commit('setEquipmentInCart',response.data.equipments);
        });
    },
    addToCart(context,equipment){
        axios.post("/cart",{'equipment_id': equipment.id}).then(()=> {
            context.commit('addToCart',equipment);
        });
    },
    deleteEquipmentIncart(context,equipment){
        axios.post("/delete_equipment_in_cart",{'equipment_id': equipment.id});
        context.commit('deleteEquipment',equipment);
    },
    updateQty(context,equipment){
        axios.post("/update_qty_cart", { 'equipment_id': equipment.id, newQuanty: equipment.pivot.quantity }).then (() =>{
        });
    },
    clearCart(context){
        axios.post('/clearCart');
        context.commit('setEquipmentInCart',[]);
    },

    // sell cart
    getSellCart(context){
        axios.get("/get_sell_cart").then(response =>{
            context.commit('setSellCart',response.data.equipments);
        });
    },
    addToSellCart(context,equipment){
        axios.post("/sell_cart",{'equipment_id': equipment.id}).then(()=> {
            context.commit('addToSellCart',equipment);
        });
    },
    deleteItemInSellCart(context,equipment){
        axios.post("/delete_equipment_in_sell_cart",{'equipment_id': equipment.id});
        context.commit('deleteItemInSellCart',equipment);
    },
    updateQtySellCart(context,equipment){
        axios.post("/update_qty_sell_cart", { 'equipment_id': equipment.id, newQuanty: equipment.pivot.quantity }).then (() =>{
        });
    },
    updateNewPriceSellCart(context,equipment){
        axios.post("/update_new_price_sell_cart", { 'equipment_id': equipment.id, newPrice: equipment.pivot.newPrice }).then (() =>{
        });
    },
    clearSellCart(context){
        axios.post('/clearSellCart');
        context.commit('setSellCart',[]);
    }
}
