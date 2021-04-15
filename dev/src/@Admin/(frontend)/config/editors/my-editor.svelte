<script lang="ts">
	import Modal from "magic/src/elements/modal.svelte";
	export let value = "";
	export let name = '';
	export let close = ()=>console.log('close')
	export let save = ()=>console.log('save')
	let modal: Modal;
</script>

<Modal bind:this={modal} icon="inverse fad fa-file-edit" title="Edit content" big>
	<nav slot="nav">
		<button on:click={()=>close()}><i class="fas fa-times"></i></button>
		<button on:click={()=>{save(value);close();}}><i class="fad fa-save"></i></button>
	</nav>
	{name}
	<textarea bind:value></textarea>
	<footer slot="footer">
		<button class="primary" on:click={()=>modal.shake()}>Most inkább asd!</button>
		<button class="success">Elfogadom a felhasználási feltételeket!</button>
	</footer>
</Modal>
