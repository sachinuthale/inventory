<template>
	<div>
		<form class="form-horizontal" method="post" @submit.prevent="onSubmit">
			<list-products-field v-bind:value="search"></list-products-field>
			<div class="form-group">
				<div class="col-md-12 mt-2 text-left">
				<button type="submit" class="btn btn-primary btn-lg">Submit</button>
			</div>
			</div>
		</form>
	</div>
</template>

<script>
import ListProductsField from './ListProductsField.vue';
export default{
	components:{
      ListProductsField
    },
	props: ['action', 'method', 'formData', 'search'],
	data(){
       return {
       		errors: [],
       		product: {
		       inputName: ListProductsField.test,
		    },
            saved: false,
       };
    },
    methods: {
	    onSubmit() {
	        this.saved = false;
	        console.log(this.inputName);
	        axios.post('issue_product', this.product)
	            .then(({data}) => this.setSuccessMessage())
	            .catch(({response}) => this.setErrors(response));
	    },

	    setErrors(response) {
	        this.errors = response.data.errors;
	    },

	    setSuccessMessage() {
	        this.reset();
	        this.saved = true;
	    },
	}
}
</script>

