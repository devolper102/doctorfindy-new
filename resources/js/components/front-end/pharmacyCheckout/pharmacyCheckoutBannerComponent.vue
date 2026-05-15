<template>
	<div>
		<div class="container">
			<div class="row mt-4 mb-4">
				<div class="col-12">
					<div class="w-100 d-inline-block pharmacy-checkout-section">
						<div class="wrapper d-xl-flex">

    <!-- LEFT -->
    <div class="cart-left box_radius">
      <h2 class="font-weight-bold text_20 mt-2 mb-2 text_black pl-3">Cart
      </h2>
      <table class="w-100">
        <thead>
          <tr>
            <th class="text-left text_14 font-weight-bold text-black">Product</th>
            <th class="text-left text_14 font-weight-bold text-black">Price</th>
            <th class="text-left text_14 font-weight-bold text-black">Quantity</th>
            <th class="text-left text_14 font-weight-bold text-black">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in cart" :key="item.id">
            <td>
              <div class="product d-flex align-items-center">
                <img :src="item.image">
                <div>
                  <h4 class="text_black text_14 mb-1">
                  {{ item.name }}</h4>
                  <p class="color-date text_13 mb-0">
                  {{ item.desc }}</p>
                </div>
              </div>
            </td>
            <td class="price font-weight-bold text_14">
            ${{ item.price }}</td>
            <td>
              <div class="qty-wrap d-flex align-items-center">
                <div class="qty-box rounded-pill d-flex align-items-center justify-content-between">
                	<a href="javascript:void(0)" class="delete" @click="remove(item)">
                		<img src="/images/trash-delete-image.svg" alt="picture">
                	</a>
                  <button class="border-0 text_14 text_black" @click="decrease(item)">−</button>
                  <span class="text_14 text_black">
                  {{ item.qty }}</span>
                  <button class="border-0 text_14 text_black" @click="increase(item)">+</button>
                </div>
              </div>
            </td>
            <td class="item-total text_14 font-weight-bold">${{ item.price * item.qty }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- RIGHT -->
    <div class="cart-right box_radius p-3">
      <h3 class="font-weight-bold text_20 text_black">Cart Total</h3>
      <div class="line d-flex align-items-center justify-content-between mb-2">
        <span class="text_black text_14">Sub Total</span>
        <span class="text_black text_14">${{ subTotal }}
        </span>
      </div>
      <div class="line d-flex align-items-center justify-content-between mb-2">
        <span class="text_black text_14">Discount</span>
        <span class="text_black text_14">${{ discount }}
        </span>
      </div>
      <div class="line d-flex align-items-center justify-content-between mb-2">
        <span class="text_black text_14">Shipping Charges
        </span>
        <span class="text_black text_14">${{ shipping }}
        </span>
      </div>
      <div class="line total">
        <span class="font-weight-bold text_16">Total</span>
        <span class="font-weight-bold text_16 float-right">${{ total }}
        </span>
      </div>
      <button class="btn checkout w-100 border-0 text_14 text-white mt-3 mb-3">PROCEED TO CHECKOUT</button>
      <button class="btn continue w-100 text_14 bg-white mb-2 mt-2">CONTINUE SHOPPING</button>
      <div class="coupon mt-3 w-100 d-inline-block">
        <input class="w-100 text_14 mb-2" type="text" placeholder="Discount Code">
        <button class="btn apply text_14 text-white border-0 float-right mt-2">APPLY COUPON</button>
      </div>
    </div>
  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

export default {
  name: "pharmacyCheckoutBannerComponent",
   data(){
    return{
      shipping:45,
      discount:5,
      cart:[
        {
          id:1,
          name:'Servaid 18X21 Non-woven Bag',
          desc:'Pack Size: 850 gm | 2 x Per Box',
          price:10,
          qty:1,
          image:'/images/detail-grid-image.png'
        },
        {
          id:2,
          name:'Servaid 18X21 Non-woven Bag',
          desc:'Pack Size: 850 gm | 2 x Per Box',
          price:10,
          qty:2,
          image:'/images/detail-grid-image.png'
        },
        {
          id:3,
          name:'Servaid 18X21 Non-woven Bag',
          desc:'Pack Size: 850 gm | 2 x Per Box',
          price:10,
          qty:1,
          image:'/images/detail-grid-image.png'
        },
        {
          id:4,
          name:'Servaid 18X21 Non-woven Bag',
          desc:'Pack Size: 850 gm | 2 x Per Box',
          price:10,
          qty:2,
          image:'/images/detail-grid-image.png'
        },
      ]
    }
  },
  computed:{
    subTotal(){
      return this.cart.reduce((s,i)=>s+i.price*i.qty,0);
    },
    total(){
      return this.subTotal - this.discount + this.shipping;
    }
  },
  methods:{
    increase(i){ i.qty++ },
    decrease(i){ if(i.qty>1) i.qty-- },
    remove(i){ this.cart=this.cart.filter(x=>x.id!==i.id) }
  }
};

</script>

<style>

</style>