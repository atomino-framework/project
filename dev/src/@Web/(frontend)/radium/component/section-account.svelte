<script lang="ts">
	import Button from "../elements/button.svelte";
	import Controls from "../elements/controls.svelte";
	import Ticket from "../elements/ticket.svelte";

	import {mdiClose, mdiDeleteForever, mdiGroup} from "@mdi/js";
</script>

<main>
	<img class="avatar" src="https://picsum.photos/30/30" alt="">
	<Ticket grow>Laborci Gergely<span slot="detail">elvis@elvis.hu</span></Ticket>
	<Button rounded shadowed error icon={mdiClose}/>
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
		.avatar {
			width: 30px;
			height: 30px;
			border-radius: 15px;
		}

	}
</style>