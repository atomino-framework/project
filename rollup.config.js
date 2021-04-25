import fs from "fs";
import svelte from "rollup-plugin-svelte";
import preprocess from "svelte-preprocess";
import css from "rollup-plugin-css-only";
import resolve from "@rollup/plugin-node-resolve";
import commonjs from "@rollup/plugin-commonjs";
import {terser} from "rollup-plugin-terser";
import globalCSS from 'svelte-preprocess-css-global';
import typescript from "rollup-plugin-typescript2";
import scss from 'rollup-plugin-scss'

let rollup = {
	verbump: function (filename) {
		return {
			writeBundle() {
				let version = fs.existsSync(filename) ? parseInt(fs.readFileSync(filename)) + 1 : 1;
				fs.writeFileSync(filename, version.toString());
				console.log("build number: " + version + ' (' + filename + ')');
			}
		}
	},
	compiler: function (input, outPath, outJS, outCSS, production) {
		return {
			input,
			output: {sourcemap: true, format: 'iife', name: 'app', file: outPath + '/' + outJS},
			plugins: [
				typescript({check: false}),
				//typescript({sourceMap: !production, target: "es6",tsconfig:false}),
				rollup.verbump("app/var/version"),
				svelte({
					emitCss: true,
					compilerOptions: {
						dev: !production,
						cssHash: ({hash, css, name, filename}) => 'Q' + hash(css)
					},
					preprocess: preprocess({style: globalCSS})
				}),
				resolve(),
				commonjs(),
				scss(),
				css({output: outCSS}),
				production && terser()
			]
		}
	}
}

const production = !process.env.ROLLUP_WATCH;

export default [
	rollup.compiler('dev/src/@Admin/(frontend)/index.ts', production ? 'dev/assets/~admin' : 'app/public/~admin', 'index.js', 'index.css', production),
	rollup.compiler('dev/src/@Web/(frontend)/index.ts', production ? 'dev/assets/~admin' : 'app/public/~web', 'index.js', 'index.css', production)
];