<template>
<div>
    <form method="post" @submit.prevent="issueProduct()">
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
          placeholder="Which product you want to issue ?"
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
          <label>Quantity avilable for issue:</label>
          <input
          type="text"
          class="form-control"
          v-model="product.inputQuantity"
          placeholder="Product Quantity available to issue ?"
          autocomplete="off"
          readonly
        />
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Name</label>
          <input
            type="text"
            @input="onChangeConsumer"
            v-model="product.inputName"
            class="form-control"
            placeholder="Whom you want to issue the product?"
          >
          <span v-if="errors.inputName" class="text-danger">{{ errors.inputName }}</span>
          <ul
            id="autocomplete-results list-group"
            v-show="isOpen1"
            class="autocomplete-results"
          >
            <li
              class="loading"
              v-if="isLoading1"
            >
              Loading results...
            </li>
            <li
              v-else
              v-for="(result, i) in resultsConsumer"
              :key="i"
              @click="setResultConsumer(result)"
              class="autocomplete-result list-group-item"
              :class="{ 'is-active': i === arrowCounter }"
            >
              {{ result.name }}
            </li>
          </ul>
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Contact</label>
          <input type="text" v-model="product.inputContact" class="form-control" placeholder="Please ask for working contact number?" readonly>
          <span v-if="errors.inputContact" class="text-danger">{{ errors.inputContact }}</span>
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Email</label>
          <input type="text" v-model="product.inputEmail" class="form-control" placeholder="Ask for email address ?" readonly>
          <span v-if="errors.inputEmail" class="text-danger">{{ errors.inputEmail }}</span>
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Address/Description/Comment</label>
          <textarea name="inputAddress" v-model="product.inputAddress" class="form-control" rows="3" readonly></textarea>
      </div>
      <div class="col-xs-12 form-group">
          <label class="control-label">Issue Quantity</label>
          <input type="text" v-model="product.inputIssueQuantity" class="form-control" placeholder="How much product are you isshuing ?">
          <span v-if="errors.inputIssueQuantity" class="text-danger">{{ errors.inputIssueQuantity }}</span>
      </div>
      <div class="col-xs-12 form-group">
        <button class="btn btn-success">Issue</button>
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
        isOpen1: false,
        results: [],
        resultsConsumer: [],
        errors: [],
        isLoading: false,
        isLoading1: false,
        arrowCounter: 0,
        product: {
          inputId: '',
          inputProductName: '',
          inputQuantity: '',
          inputConsumerId: '',
          inputName: '',
          inputContact: '',
          inputEmail: '',
          inputAddress: '',
          inputIssueQuantity: ''
        },
      };
    },

    methods: {
      //Get Product list
      onChange() {
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
        this.product.inputQuantity = result.avl_quantity;
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
        this.product.inputId = this.results[this.arrowCounter].id;
        this.product.inputProductName = this.results[this.arrowCounter].name;
        this.product.inputQuantity = this.results[this.arrowCounter].avl_quantity;
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

      issueProduct(){
          if(this.product.inputQuantity < this.product.inputIssueQuantity ){
            alert("Can't issue the Product");
          }else{
            axios.post('issue_product', this.product).then(response => {
                this.errors = [];
                this.product.inputId = '',
                this.product.inputProductName = '',
                this.product.inputQuantity = '',
                this.product.inputConsumerId = '',
                this.product.inputName = '',
                this.product.inputContact = '',
                this.product.inputEmail = '',
                this.product.inputAddress = '',
                this.product.inputIssueQuantity = '',
                console.log(response);
            }).catch(error => {
                this.errors = error.response.data.errors;
                console.log(error);
            });
          }
      },

      //get consumer list
      onChangeConsumer() {
        // Let's warn the parent that a change was made
        this.$emit('input', this.product.inputName);

        // Is the data given by an outside ajax request?
        if (this.isAsync) {
          this.isLoading1 = true;
        } else {
          // Let's  our flat array
          this.filterResultsConsumer();
          this.isOpen1 = true;
        }
      },

      filterResultsConsumer() {
        // get data from list
        axios.get('searchConsumer',{params: {query: this.product.inputName}}).then(response => {
          this.resultsConsumer = response.data;
        });
      },

      setResultConsumer(result) {
          this.product.inputConsumerId = result.id;
          this.product.inputName = result.name;
          this.product.inputContact = result.contact;
          this.product.inputEmail = result.email;
          this.product.inputAddress = result.address;
          this.isOpen1 = false;
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
