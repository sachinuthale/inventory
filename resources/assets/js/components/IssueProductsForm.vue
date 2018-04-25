<template>
	<div>
		<div>Parents data name value: {{selection}}</div>
		<hr>
		<list-products-field v-model="selection"></list-products-field>

	</div>
</template>

<script>
export default {
	data () {
    return {
      selection: ''
     }
    }
};
</script>

