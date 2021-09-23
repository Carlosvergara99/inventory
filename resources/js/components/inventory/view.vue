<template>
<div>
<Menu></Menu>


<div class="container">
      <div class="d-flex p-2 flex-column">
       <div class="d-flex">
         <div class="mr-auto p-2">
            <form    @submit.prevent="getinventory()">
             <div class="form-row">
               <div class="col">
                 <input type="date" v-model="filter.delivery_date" class="form-control" placeholder="Fecha de entrega">
               </div>
                <div class="col">
                 <input type="text" v-model="filter.order_number" class="form-control" placeholder="ID Pedido">
                </div>
                 <button class="btn btn-secondary " >Filtar</button>

              </div>
              
           </form>
       </div>
  <div class="p-2">           
        <button class="btn btn-success " data-toggle="modal" data-target="#addNew" @click="openModalWindow">+</button>
   </div>
</div>

         
            
      </div>
 <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col"># </th>
      <th scope="col">Productos</th>
      <th scope="col" >ID Pedido</th>
      <th scope="col">Fecha de entrega</th>

    </tr>
  </thead>
  <tbody>
    <tr  v-for="inventory in inventories" :key="inventory.id">
      <th>{{inventory.id}}</th>
      <th>
         <li v-for="product in inventory.products" :key="product.id">  
           <span class="badge badge-primary"> {{product.name}}</span>
           <span class="badge badge-danger">Stok disponible: {{product.stock}}</span>
 
           
         </li>
      </th>
      <th>{{inventory.order_number}}</th>
      <th>{{inventory.delivery_date}}</th>
    </tr>
  </tbody>
</table>

</div>
<Create  :products="products"  @GetInventory="getinventory"></Create>
</div>
  

</template>

<script>
import Menu from '../menu.vue';
import Create from './create.vue';

export default {
    components:{
        Menu,
        Create
    },
    data(){
        return{
         products:[],
         inventories:[],
         filter:{
           delivery_date:'',
           order_number:''
         }
        }
    },
    mounted(){
       this.GetProducts()
       this.GetInventory()
    },
    methods:{
      GetInventory(){
       axios.post('api/inventory/get',this.filter).then((response) => {
             this.inventories =response.data
             this.filter={
                delivery_date:'',
               order_number:''
             }
            }).catch((errors) => {
        })
      },
      getinventory(){
       this.GetInventory()
      },
         GetProducts(){
           axios.get('api/products/get').then((response) => {
             this.products =response.data
            }).catch((errors) => {
        })
      },
         
        openModalWindow(){
         $('#addNew').modal('show');

        }
    }

}
</script>