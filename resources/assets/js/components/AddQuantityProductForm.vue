<template>
<div>
    <div class="alert alert-success" v-if="saved">
        <strong>Success!</strong> Added successfully.
    </div>
    <form method="post" @submit.prevent="addQuantity()">
      <div class="form-group">
        <label>Product Name</label>
        <input
          type="text"
          class="form-control"
          @input="onChange"
          v-model="product.inputProductName"
          @keyup.down="onArrowDown"
          @keyup.up="onArrowUp"
          @keyup.enter="onEnter"
          placeholder="Which product you want to add Quantity ?"
          autocomplete="off"
        />
        <span v-if="errors.inputProductName" class="text-danger">{{ errors.inputProductName }}</span>
        <ul
          id="autocomplete-results list-group"
          v-show="isOpen"
          class="autocomplete-results"
        >
          <li
            class="loading"
            v-if="isLoading"
          >
            Loading results...
          </li>
          <li
            v-else
            v-for="(result, i) in results"
            :key="i"
            @click="setResult(result)"
            class="autocomplete-result list-group-item"
            :class="{ 'is-active': i === arrowCounter }"
          >
            {{ result.name }}
          </li>
        </ul>
      </div>
      <div class="form-group">
          <label>Manufacturer</label>
          <input
          type="text"
          class="form-control"
          v-model="product.inputCompany"
          placeholder="Which Company ?"
          autocomplete="off"
          readonly
        />
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Available Quantity</label>
          <input type="text" v-model="product.inputAvlQuantity" class="form-control" placeholder="Number of Available Quantity" readonly>
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Unit Price</label>
          <input type="text" v-model="product.inputPrice" class="form-control" placeholder="Price of the product is?" readonly>
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Description</label>
          <textarea v-model="product.inputDiscription" class="form-control" rows="3" readonly></textarea>
      </div>
      <div class="form-group">
          <label>Quantity</label>
          <input type="text" class="form-control" v-model="product.inputQuantity" placeholder="How many ?">
          <span v-if="errors.inputQuantity" class="text-danger">{{ errors.inputQuantity }}</span>
      </div>
      <div class="form-group">
          <label>Purchase Date</label>
          <input type="text" class="form-control" v-model="product.inputPurchaseDate"  placeholder="When-yyyy/m/d??" >
          <span v-if="errors.inputPurchaseDate" class="text-danger">{{ errors.inputPurchaseDate }}</span>
      </div>
      <div class="col-xs-12 form-group">
        <button class="btn btn-success">Add Quantity</button>
      </div>
    </form>
</div>
</template>

<script>
  export default {
    name: 'list-products-field',

    props: {
      isAsync: {
        type: Boolean,
        required: false,
        default: false,
      },
      value: {
        type: String,
        required: true
      },
    },

    data() {
      return {
        isOpen: false,
        results: [],
        errors: [],
        isLoading: false,
        arrowCounter: 0,
        saved: false,
        product: {
          inputId: null,
          inputProductName: null,
          inputAvlQuantity: null,
          inputQuantity: null,
          inputCompany: null,
          inputPrice: null,
          inputDiscription: null,
          inputPurchaseDate: null,
        },
      };
    },

    methods: {
      //Get Product list
      onChange() {
        this.saved = false;
        // Let's warn the parent that a change was made
        this.$emit('input', this.product.inputProductName);

        // Is the data given by an outside ajax request?
        if (this.isAsync) {
          this.isLoading = true;
        } else {
          // Let's  our flat array
          this.filterResults();
          this.isOpen = true;
        }
      },

      filterResults() {
        // get data from list
        axios.get('search',{params: {query: this.product.inputProductName}}).then(response => {
          this.results = response.data;
        });
      },

      setResult(result) {
        this.product.inputId = result.id;
        this.product.inputProductName = result.name;
        this.product.inputAvlQuantity = result.avl_quantity;
        this.product.inputCompany = result.company,
        this.product.inputPrice = result.price,
        this.product.inputDiscription = result.description,
        this.isOpen = false;
      },

      onArrowDown(evt) {
        if (this.arrowCounter < this.results.length) {
          this.arrowCounter = this.arrowCounter + 1;
        }
      },

      onArrowUp() {
        if (this.arrowCounter > 0) {
          this.arrowCounter = this.arrowCounter -1;
        }
      },

      onEnter() {
        this.product.inputId = result.id;
        this.product.inputProductName = result.name;
        this.product.inputAvlQuantity = result.avl_quantity;
        this.product.inputCompany = result.company,
        this.product.inputPrice = result.price,
        this.product.inputDiscription = result.description,
        this.isOpen = false;
        this.arrowCounter = -1;
      },

      handleClickOutside(evt) {
        if (!this.$el.contains(evt.target)) {
          this.isOpen = false;
          this.isOpen1 = false;
          this.arrowCounter = -1;
        }
      },

      addQuantity(){
          this.saved = false;
          axios.post('save_product_quantity', this.product).then(response => {
                this.saved = true;
                this.errors = [];
                this.product.inputId = null,
                this.product.inputProductName = null,
                this.product.inputAvlQuantity = null,
                this.product.inputQuantity = null,
                this.product.inputCompany = null,
                this.product.inputPrice = null,
                this.product.inputDiscription = null,
                this.product.inputPurchaseDate = null,
                console.log(response);
            }).catch(error => {
                this.errors = error.response.data.errors;
                console.log(error);
            });
        },
    },
    mounted() {
      document.addEventListener('click', this.handleClickOutside);
    },
    destroyed() {
      document.removeEventListener('click', this.handleClickOutside)
    }
  };
</script>

<style>
  .autocomplete {
    position: relative;
  }

  .autocomplete-results {
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    height: 120px;
    overflow: auto;
    width: 100%;
  }

  .autocomplete-result {
    list-style: none;
    text-align: left;
    padding: 4px 2px;
    cursor: pointer;
  }

  .autocomplete-result.is-active,
  .autocomplete-result:hover {
    background-color: #4AAE9B;
    color: white;
  }

</style>
