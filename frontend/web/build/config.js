import Path from "path";

let cwd = process.cwd();
let root = Path.resolve(cwd + '/../..');

let path = {
	cwd: cwd,
	node_modules: cwd + '/node_modules',
	src: cwd + '/src',
	root: root,
	public: {
		dev: root + '/var/public',
		prod: root + '/etc/public',
		fonts: root + '/etc/public/~fonts',
	}
};

function rollup(suffix = "", prod = false) {
	return {
		src: path.src,
		entry: path.src + '/index.ts',
		versionFile: path.root + '/var/etc/version',
		out: {
			path: (prod ? path.public.prod : path.public.dev) + suffix,
			js: 'index.js',
			css: 'index.css',
		},
	}
}

let config = {
	path,
	rollup
}

export default config;
