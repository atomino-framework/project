<script lang="ts">
	import Button from "../elements/button.svelte";
	import Controls from "../elements/controls.svelte";
	import {mdiRecycleVariant, mdiDeleteForever, mdiImageAlbum} from "@mdi/js";
	import Account from "./section-account.svelte"
	import ListHead from "./section-list-head.svelte"
	import TabBar from "./section-tab-bar.svelte";
	import Nav from "./section-nav.svelte";
</script>

<main>
	<section class="account head"><Account/></section>
	<section class="list-head head"><ListHead/></section>
	<section class="tab-bar head"><TabBar showVerticalTabs/></section>
	<section class="nav"><Nav/></section>
	<section class="list"></section>
	<section class="doc">
		<Controls>
			<Button rounded shadowed>Hello</Button>
			<Button rounded shadowed square info icon={mdiRecycleVariant}/>
			<Button rounded shadowed square error icon={mdiDeleteForever}/>
			<Button warning icon={mdiImageAlbum}> and some text</Button>
		</Controls>
	</section>
</main>

<style lang="scss">
    @import "../vars.scss";
	main{
		display: grid;
		height: 100%;
        grid-template-columns: 201px 301px 1fr;
        grid-template-rows: 55px 1fr;
		>*{
			position: relative;
			overflow: hidden;
		}
		.head{
			border-bottom: 5px solid $color-ramp-deep;
			background-color: $color-ramp-dusty;
		}
		.tab-bar{
		}
		.account, .list-head, .nav, .list{
			&:after{
				position: absolute;
				top: $gap-big;
				right: 0;
				bottom: $gap-big;
				content:"";
				border-right: 1px solid $color-ramp-paper;
			}
		};
		.nav, .list{
			&:after{
				border-right: 1px solid $color-ramp-dusty;
			}
		};
	}
</style>