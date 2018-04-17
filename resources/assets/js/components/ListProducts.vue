<template>
    <div>
        <table class="table">
	        <thead>
		        <tr>
			        <th scope="col">#</th>
			        <th scope="col">Name</th>
			        <th scope="col">Company</th>
			        <th scope="col">Quantity</th>
			        <th scope="col">Unit Price</th>
			        <th scope="col">Label</th>
			        <th scope="col">Purchase Date</th>
		        </tr>
	        </thead>
	        <tbody>
		        <tr v-for='(product, index) in products'>
			        <th scope="row">{{index+1}}</th>
			        <td>{{ product.name }}</td>
			        <td>{{ product.company}}</td>
			        <td>{{ product.quantity}}</td>
			        <td>{{ product.price}}</td>
			        <td>{{ product.label}}</td>
			        <td>{{ product.purchase_date}}</td>
		        </tr>
	        </tbody>
        </table>
        <div>
	        <paginate
		        :page-count="pageCount"
		        :click-handler="getProducts"
		        :prev-text="'Prev'"
		        :prev-class="'page-item'"
		        :prev-link-class="'page-link'"
		        :next-text="'Next'"
		        :next-class="'page-item'"
		        :next-link-class="'page-link'"
		        :container-class="'pagination justify-content-center'"
		        :page-class="'page-item'"
		        :page-link-class="'page-link'">
	        </paginate>
        </div>
     </div>
</template>

<script>
	export default{
		data() {
            return {
                products: [],
                product: {
                	id: 0,
                	name: '',
                	quantity:'',
                	company: '',
                	type:'',
                	price:'',
                	label:'',
                	purchase_date:'',
                	description:''
                },
                pageCount: 1,
                endpoint: 'list_products_test?page='
            };
        },

		created(){
			this.getProducts();
		},

		methods:{
			getProducts(page = 1){
				axios.get('list_products_test?page='+page).then( response => {
					console.log(response);
					this.products = response.data.data;
					this.pageCount = response.data.last_page;
				}).catch(function(error) {
					console.log(error);
				});
			}
		}
	}
</script>