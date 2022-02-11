<script lang="ts">
	import AbstractPage from "gold-admin/app/abstract-page";

	export let page: AbstractPage;
	let data = {userCount: 0};
	async function getData() {
		data = await fetch("/api/dashboard")
			.then(res => res.json());
	}
	getData();
</script>

<div class="box">
	There are <b>{data.userCount}</b> users.
</div>
