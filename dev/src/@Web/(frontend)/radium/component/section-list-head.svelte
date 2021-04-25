<script lang="ts">
	import Button from "../elements/button.svelte";
	import Controls from "../elements/controls.svelte";
	import Ticket from "../elements/ticket.svelte";

	import {mdiReload, mdiPlus, mdiAccountGroup} from "@mdi/js";
</script>

<main>
	<Ticket grow icon={mdiAccountGroup}>Users<span slot="detail">count: <b>12345</b> | pages: <b>124</b></span></Ticket>
	<Button rounded shadowed icon={mdiReload}/>
	<Button rounded shadowed success icon={mdiPlus}/>
</main>

<style lang="scss">
	@import "../vars.scss";
	@import "../mixins.scss";

	main {
		height: 50px;
		display: flex;
		align-items: center;
		padding: 0 $gap-big;
		gap: $gap-small;
		.name{
			flex-grow: 1;
		}
	}
</style>