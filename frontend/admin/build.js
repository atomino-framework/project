import copydir from "copy-dir";
import fs from "fs";

let root = process.cwd() + '/../..';

let path = {
	public: root + '/var/public',
	assets: root + '/assets/public',
	packagesfolder: process.cwd() + '/node_modules'
};

let packages = JSON.parse(fs.readFileSync('./package.json'));

fs.mkdirSync(path.assets + '/~fonts', {recursive: true});

class Jobs {
	static fontawesome() {
		if (typeof packages.dependencies['@fortawesome/fontawesome-pro'] !== 'undefined') {
			console.log('copy fontawesome pro to assets');
			copydir.sync(path.packagesfolder + "/@fortawesome/fontawesome-pro/webfonts", path.assets + "/~fonts/fontawesome-pro")
		}
		console.log('copy fontawesome free to assets');
		copydir.sync(path.packagesfolder + "/@fortawesome/fontawesome-free/webfonts", path.assets + "/~fonts/fontawesome-free")
	}

	static fonts() {
		for (let pkg in packages.dependencies) if (pkg.startsWith('@fontsource/')) {
			let name = pkg.substr('@fontsource/'.length);
			console.log('copy ' + name + " to assets");
			copydir.sync(path.packagesfolder + '/@fontsource/' + name + '/files', path.assets + "/~fonts/" + name);
		}
	}
}

let command = process.argv[2];
if (typeof Jobs[command] === "function") Jobs[command]();
else console.log("command not found");