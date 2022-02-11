<script lang="ts">
	import List from "gold-admin/list/list";

	export let list: List;
	let filter = list.filter;
	filter.name = "";
</script>

<div>
	<input class="input is-size-7 mb-1" placeholder="email" type="text" bind:value={list.filter.email}/>
	<button class="button is-small is-pulled-right" on:click={list.reload()}>
		<span class="icon is-small"><i class="fa fa-search"></i></span>
		<span>Search</span>
	</button>
</div>

<style lang="scss">
	div {
		display: flex;
		gap: 5px;
	}
</style>
