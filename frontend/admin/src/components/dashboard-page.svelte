<script lang="ts">
	import AbstractPage from "gold-admin/app/abstract-page";
	export let page:AbstractPage;
	let title = page.$title;
</script>

<div class="box">
	This is the dashboard {$title}
</div>
