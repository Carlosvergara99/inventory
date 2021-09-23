<template>
<div>
      <div class="modal fade bd-example-modal-lg" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5  class="modal-title" id="addNewLabel">Crear inventario </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               <form     @submit.prevent="CreateInvetory()">
                     <div class="modal-body">
                      <div class="form-row">
                         <div class="form-group col-md-6 ">
                                 <label>Fecha de entrega </label>
                                 <input v-model="form.delivery_date" type="date" class="form-control"  >
                         </div>  
                          <div class="form-group col-md-6 ">
                                 <label>ID  Pedido </label>
                                 <input v-model="form.order_number" type="text" placeholder="Numero de pedido" class="form-control"  >
                         </div> 

                          <div class="form-group col-md-6">
                                 <label> Producto </label>
                                  <select v-model="form.id_prodct" class="form-control">
                                      <option value="" selected>Seleccione</option>
                                      <option v-for="iten in products"  v-bind:value="iten.id">
                                          {{iten.name}}
                                      </option>
                                  </select>
                         </div>   
                        <div class="form-group col-md-3">
                                 <label> Cantidad </label>
                                 <input v-model="form.quantity" type="number" class="form-control"  placeholder="Cantidad">
                         </div> 
                        <div class="form-group col-md-3 p-2 d-flex flex-column align-items-center">
                            <br>
                            <button type="button" class="btn btn-info" @click="NewProduct">Agregar Producto</button>
                         </div> 
                     </div>
                     <table class="table table-hover">
                           <thead>
                               <tr>
                                   <th>Nombre</th>
                                   <th>Cantidad</th>
                                   <th>Precio</th>
                                   <th>Stock</th>
                                   <th>Total</th>
                                   <th>Accion</th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr v-for="(item, index) in product" :key="item.id">
                                <th>{{item.name}}</th>
                                <th>{{item.quantity}}</th>
                                <th>{{item.price}}</th>
                                <th>{{item.stock}}</th>
                                <th>{{item.total}}</th>
                                <button type="button" class="btn btn-danger" @click="DeleteProduct(index)">X</button>
                                <th></th>
                               </tr>
                           </tbody>
                     </table>
                 </div>

             <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Create</button>
           </div>
        </form>
       </div>
    </div>
</div>
</div>
</template>

<script>
export default {
     props: {
   products: Array
 },
    data(){
        return{
           form:{
               id_prodct:'',
               quantity:'',
               order_number :''
           },
           product:[],
        }
    },
   methods:{
       CreateInvetory(){
           if (this.product.length == 0) {
                Swal.fire({
                   icon: 'error',title: 'el producto debe ser agregado'
                })     
           }else if(this.form.delivery_date ==""){
               Swal.fire({
                   icon: 'error',title: 'la fecha de entrega es obligatoria'
                }) 
            } else if(this.form.order_number ==""){
               Swal.fire({
                   icon: 'error',title: 'el id de pedido es obligatoria'
                }) 
           }else{
               const data = {
                    'delivery_date' :this.form.delivery_date,
                    'order_number':this.form.order_number,
                    'products' : this.product 
               }
               axios.post('api/inventory/create',data).then((response) => {    
                      $('#addNew').modal('hide');
                          Swal.fire({
                             icon: 'success',title: 'el inventario se ha registrado con exito'
                         })
                       this.form={
                           id_prodct:'',
                           delivery_date:'',
                           quantity:'',
                           order_number:''
                        }
                        this.product =[]
                          this.$emit('GetInventory');
                      }).catch((errors) => {
                        Swal.fire({
                          icon: 'error',title: 'ha ocurrido un fallo en el servidor'
                         })
                 })
           }
       },
    NewProduct(){
         let dataproduct = this.product.filter(p=> p.id === this.form.id_prodct)
          
           if (this.form.id_prodct == '' ) {
                 Swal.fire({
                   icon: 'error',title: 'el campo producto es obligatorio'
               })
          }else if ( dataproduct.length >0) {
              Swal.fire({
                   icon: 'error',title: 'el producto ya esta agregado'
                })        

         } else if(this.form.quantity == ''){
               Swal.fire({
                   icon: 'error',title: 'el campo cantidad es obligatorio'
               })
          }else {
            const data ={
               'id':this.form.id_prodct,
               'quantity':this.form.quantity
            }
             axios.post('api/products/stock',data).then((response) => {
                    if (response.data != '') {
                        this.form.id_prodct =''
                           
                           
                        this.form.quantity =''
                         this.product.push(response.data)

                    }else{
                         Swal.fire({
                   icon: 'error',title: 'No hay stock suficente para este producto'
                 })
                    }
                   
                  }).catch((errors) => {
                  Swal.fire({
                   icon: 'error',title: 'No hay stock suficente para este producto'
                 })
               })
          }
        
    },
    DeleteProduct(index){
        this.product.splice(index, 1)

    }
   }
}
</script>

<style>

</style>