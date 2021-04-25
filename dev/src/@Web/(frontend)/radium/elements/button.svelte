<script lang="ts">
	export let square: boolean = false;
	export let rounded: boolean = false;
	export let shadowed: boolean = false;
	export let info: boolean = false;
	export let warning: boolean = false;
	export let success: boolean = false;
	export let tiny: boolean = false;
	export let transparent: boolean = false;
	export let error: boolean = false;
	export let icon: string | boolean = false;
	let text = typeof $$slots.default !== "undefined";
</script>

<button on:click class:rounded class:tiny class:shadowed class:transparent class:square class:icon class:error class:success class:warning class:info class:text>
	{#if icon}
		<svg viewBox="0 0 24 24">
			<path d={icon}></path>
		</svg>
	{/if}
	{#if text}
		<span><slot/></span>
	{/if}
</button>

<style lang="scss">
	@import "../vars.scss";
	$icon-height: 18px;
	$icon-height-tiny: 12px;
	$tiny-height: 16px;
	button {
		padding: 0;
		min-width: $brick-height;
		vertical-align: middle;
		font-weight: 500;
		height: $brick-height;
		line-height: $brick-height;
		text-align: center;
		background-color: $color-ramp-paper;
		border: none;
		border-radius: $radius-small;
		transition: all .3s;
		cursor: pointer;
		svg { margin: (($brick-height - $icon-height) / 2) 0; height: $icon-height;}
		path { transition: all .3s;}
		&:not(.square) {padding: 0 $gap-small;}
		&.rounded { border-radius: $radius-big;}
		&.shadowed { box-shadow: 0 4px 4px rgba(0, 0, 0, .4);}
		&.icon.text {
			display: flex;
			span { padding-left: $gap-small;}
		}


		&.tiny{
			min-width: $tiny-height;
			height: $tiny-height;
			font-size:10px;
			padding:0;
			svg{
				margin: (($tiny-height - $icon-height-tiny) / 2) 0;
				height: $icon-height-tiny;
			}
		}

		&.transparent{
			background-color: transparent;
		}
		color: $color-ramp-light;
		svg {fill: $color-ramp-light;}
		&.error:hover {
			color: $color-error;
			path {fill: $color-error;}
		}
		&.info:hover {
			color: $color-info;
			path {fill: $color-info;}
		}
		&.warning:hover {
			color: $color-warning;
			path {fill: $color-warning;}
		}
		&.success:hover {
			color: $color-success;
			path {fill: $color-success;}
		}
		&:hover {
			background-color: $color-ramp-paper-light;
			path {fill: $color-ramp-bright;}
			color: $color-ramp-bright;
		}
	}
</style>