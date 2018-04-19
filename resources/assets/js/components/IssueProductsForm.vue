<template>
	<div>
		<input
			type="text"
			placeholder="what are you looking for?"
			v-model="query"
			@input="autoComplete"
			class="form-control"
			id="input"
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
	}
}
</script>