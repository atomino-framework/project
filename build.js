import copydir from "copy-dir";
import fs from "fs";

let root = process.cwd();

let packages = JSON.parse(fs.readFileSync('./package.json'));

let path = {
	public: root + '/app/public',
	assets: root + '/dev/assets',
};

fs.mkdirSync(path.assets +'/~fonts', {recursive:true});

class Jobs {
	static fontawesome(){
		if(typeof packages.dependencies['@fortawesome/fontawesome-pro'] !== 'undefined'){
			console.log('copy fontawesome pro to assets');
			copydir.sync(root + "/node_modules/@fortawesome/fontawesome-pro/webfonts", path.assets + "/~fonts/fontawesome-pro")
		}
		console.log('copy fontawesome free to assets');
		copydir.sync(root + "/node_modules/@fortawesome/fontawesome-free/webfonts", path.assets + "/~fonts/fontawesome-free")
	}

	static assets() {
		console.log('copy assets to public');
		copydir.sync(path.assets, path.public);
	}

	static fonts() {
		for(let pkg in packages.dependencies)if(pkg.startsWith('@fontsource/')){
			let name = pkg.substr('@fontsource/'.length);
			console.log('copy '+name+" to assets");
			copydir.sync(root + '/node_modules/@fontsource/' + name + '/files', path.assets + "/~fonts/" + name);
		}
	}
}

let command = process.argv[2];
if (typeof Jobs[command] === "function") Jobs[command]();
else console.log("command not found");