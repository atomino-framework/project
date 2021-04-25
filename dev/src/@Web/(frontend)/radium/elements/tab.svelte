<script lang="ts">
	export let icon: string | boolean = false;
	export let selected: boolean = false;
	import {mdiClose} from "@mdi/js";

	import Ticket from "./ticket.svelte";
	import Button from "./button.svelte";
</script>

<main class:selected>
	<section>

		<Ticket icon={icon} hilited={selected} maxWidth="140">
			<slot/>
			<span slot="detail"><slot name="detail"/></span>
		</Ticket>
		<Button tiny transparent icon={mdiClose}/>
	</section>
</main>

<style lang="scss">
	@import "../vars.scss";

	$bottom-border: 2px;

	main {
		&.selected section {
			background-color: $color-ramp-deep;

		}
		&:not(.selected):hover section {
			border-color: $color-info-dark
		}
		position: relative;

		&:after {
			position: absolute;
			right: 0;
			top: $gap-big;
			bottom: $gap-big;
			content: "";
			border-right: 1px solid $color-ramp-paper;
		}
		section {
			cursor: pointer;
			display: flex;
			gap: $gap-big;
			align-items: center;
			height: (50px -  $gap-small);
			margin: $gap-small $gap-small 0;
			border-bottom: $bottom-border solid transparent;
			padding: 0 $gap-small ($gap-small - $bottom-border);
			transition: all .3s;
			border-radius: $radius-big $radius-big 0 0;
		}
	}
</style>