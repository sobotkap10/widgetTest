<template>
  <div>

      <section class="mt-10">
        
          <p class="mb-3">Please use form below to generate order pack based on entered quantity:</p>

          <form @submit.prevent class="w-1/3">
            <fieldset>
                <input type="number" @keyup="results = null" v-model="orderSize" name="orderSize" class="border w-full py-1 px-2" placeholder="Enter order size e.g. 750">
            </fieldset>
            
            <!-- <div class="text-red-500 font-medium">Please enter order quantity</div> -->
            
            <div class="text-right mt-2">
                <button @click="sendingData" @submit.prevent class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-300">Generate Packs</button>
            </div>
        </form>

        </section>

        <hr class="my-5">

        <section v-show="results" class="bg-gray-100 rounded-lg p-10">

            <div>
                <span class="block">Ordered Amount: <span v-text="orderSize" class="font-medium"></span>  Widgets</span>
            </div>
                
            <div class="mt-10">
                <span class="block font-medium mb-2">Pack(s) to send: </span>

                <ul>
                  <li v-for="(item, key)  in results">
                      {{ item }}x - {{ key }} widgets  
                  </li>
                </ul>

            </div>
        </section>

  </div>
</template>

<script>
  export default {

    data() {
      return { 
        orderSize: null,
        results: null
      }
    },
    methods: {
      sendingData(){
        if (this.orderSize) {

          axios.post('/generatePacksForDelivery', {'orderSize': this.orderSize})
          .then(
                   (response) => {
                    this.results = response.data
                  }
              )
          .catch(
                  error => console.log(error)
              )
        }
        else{
          alert('Please enter size of your order')
        }
      }
    },

  };
</script>