<template id="child">
   <input type="text" v-bind:value="value" v-on:input="updateValue($event.target.value)">
</template>

<script>
	export default{
		props: ['value'],
		methods: {
		    updateValue: function (value) {
		      this.$emit('input', value);
		    }
		}
	}
</script>