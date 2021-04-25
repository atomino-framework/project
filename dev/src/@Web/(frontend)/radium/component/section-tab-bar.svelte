<script lang="ts">
	import Tab from "../elements/tab.svelte";
	import Button from "../elements/button.svelte";
	import {mdiAccount, mdiMenu} from "@mdi/js";

	export let showVerticalTabs: boolean = false;

	let tabBar: HTMLElement;

	// function overflow() {
	// 	let over = typeof tabBar && (tabBar.scrollHeight > tabBar.clientHeight || tabBar.scrollWidth > tabBar.clientWidth)
	// 	console.log(over)
	// }
	//
	// function mousemove(event) {
	// 	let width = tabBar.getBoundingClientRect().width;
	// 	let mouse = event.clientX - tabBar.getBoundingClientRect().x;
	// 	if (mouse > width - 100) tabBar.scrollLeft = tabBar.scrollWidth;
	// 	else if (mouse < 100) tabBar.scrollLeft = 0;
	// 	else tabBar.scrollLeft = (mouse - 100) / (width - 200) * (tabBar.scrollWidth - width);
	// }

	let tabs = [
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>", selected: true},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
		{icon: mdiAccount, label: "laborci gergely", detail: "id: <b>12</b>"},
	]

	function showTabs() {
		console.log("show menu")
	}

</script>

<main>
	{#if showVerticalTabs}
		<div class="button">
			<Button on:click={showTabs} rounded shadowed icon={mdiMenu}/>
		</div>
	{/if}
	{#each tabs as tab}
		<Tab selected={tab.selected === true} icon={tab.icon}>{tab.label}<span slot="detail">{@html tab.detail}</span></Tab>
	{/each}
</main>

<style lang="scss">
	@import "../vars.scss";
	@import "../mixins.scss";

	main {
		.button {
			display: flex;
			align-items: center;
			padding: 0 $gap-big;
			position: relative;
			height: 50px;
			&:after {
				position: absolute;
				right: 0;
				top: $gap-big;
				bottom: $gap-big;
				content: "";
				border-right: 1px solid $color-ramp-paper;
			}
		}
		overflow-x: hidden;
		height: 50px;
		display: flex;
		align-items: center;
	}
</style>
