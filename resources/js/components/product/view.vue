<template>
 <div >
  <Menu></Menu>
  

  <div class="p-4 container">
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Cantidad disponible</th>

    </tr>
  </thead>
  <tbody>
    <tr v-for="product in products" :key="product.id">
        <th>{{product.id}}</th>
        <th>{{product.name}}</th>
        <th>{{product.quantity}}</th>
        <th>{{product.price}}</th>
        <th>{{product.stock}}</th>
    </tr>
  </tbody>
</table>
 
  </div>
 
 </div>
</template>

<script>
import Menu from '../menu.vue';
export default {
    components:{
        Menu   
    },
    data(){
        return{
          products:[]
        }
    },
    mounted(){
     this.getProducts()
    },
    methods:{
      getProducts(){
       axios.get('api/products/get').then((response) => {
             this.products =response.data
            }).catch((errors) => {
        })
      }

    }

}
</script>

<style>

</style>