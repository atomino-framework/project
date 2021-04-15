class Jobs {
	static copy() {console.log('copy...')}
	static font() { console.log('font...')}
}
let command = process.argv[2];
if (typeof Jobs[command] === "function") Jobs[command]();
else console.log("command not found");