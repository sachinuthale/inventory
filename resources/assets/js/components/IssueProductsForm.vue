<template>
	<div>
		<input
			type="text"
			placeholder="what are you looking for?"
			v-model="query"
			@input="autoComplete"
			class="form-control"
			@keyup.down="onArrowDown"
			@keyup.up="onArrowUp"
      		@keyup.enter="onEnter"
		>
		<div class="panel-footer" v-if="results.length">
			<ul class="list-group" v-show="isOpen">
				<li class="list-group-item" 
					v-for="(result, i) in results" 
					@click="setResult(result)" 
					:key="i"					
				>
				{{ result.name }}
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
export default{
	data(){
		return {
			query: '',
			results: [],
			isOpen: false,
			arrowCounter: 0,
		}
	},
	methods: {
		autoComplete(){
			this.isOpen = true;
			this.results = [];
			if(this.query.length > 2){
				axios.get('search',{params: {query: this.query}}).then(response => {
				this.results = response.data;
			});
			}
		},
		setResult(result) {
			console.log(result.name)
	        this.query = result.name;
	        this.isOpen = false;
	    },
	    onArrowDown(evt) {
	    	console.log(this.arrowCounter);
	    	console.log(this.results.length);
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
	        this.query = this.results[this.arrowCounter].name;
	        this.isOpen = false;
	        this.arrowCounter = -1;
	      },
	}
}
</script>