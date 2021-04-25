<script lang="ts">
	export let wide: boolean = false;
</script>

<div class:wide>
	<slot/>
</div>

<style lang="scss">
	@import "../vars.scss";
	div {
		flex-direction: row;
		display: inline-flex;
		flex-wrap: wrap;
		gap: $gap-small;
		&.wide { gap: $gap-big}
	}
</style>