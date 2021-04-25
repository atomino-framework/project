<script lang="ts">
	export let icon: string | boolean = false;
	export let grow: boolean = false;
	export let hilited: boolean = false;
	export let maxWidth: number|null = null;
</script>

<main class:grow class:hilited style={"max-width:" + (maxWidth ? maxWidth +"px" : "auto")}>
	<div class="main">
		{#if icon}
			<svg viewBox="0 0 24 24">
				<path d={icon}></path>
			</svg>
		{/if}
		<span>
			<slot/>
		</span>
	</div>
	{#if $$slots.detail}
		<div class="detail">
			<slot name="detail"/>
		</div>
	{/if}
</main>

<style lang="scss">
	@import "../vars.scss";
	@import "../mixins.scss";
	main {
		font-size: 12px;
		font-weight: bold;
		color: $color-ramp-light;
		&.hilited {
			color: $color-ramp-bright;
			div.main svg {
				fill: $color-ramp-white;
			}
		;
		}
		&.grow {
			flex-grow: 1;
		}
		div.main {
			line-height: 14px;
			display: flex;
			align-items: center;

			svg {
				min-width: 14px;
				height: 14px;
				fill: $color-ramp-bright;
				margin-right: $gap-small / 2;
			}
			span{
				display: inline-block;
				@include ellipsis;
			}
		}
		.detail {
			@include ellipsis;
			content: attr(sub);
			font-size: 10px;
			font-weight: lighter;
			display: block;
			line-height: 12px;
		}
	}
</style>