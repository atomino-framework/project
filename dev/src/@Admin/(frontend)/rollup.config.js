import fs from "fs";
import svelte from "rollup-plugin-svelte";
import preprocess from "svelte-preprocess";
import css from "rollup-plugin-css-only";
import resolve from "@rollup/plugin-node-resolve";
import commonjs from "@rollup/plugin-commonjs";
import {terser} from "rollup-plugin-terser";
import globalCSS from 'svelte-preprocess-css-global';
import typescript from "rollup-plugin-typescript2";
import scss from 'rollup-plugin-scss';
//import postcss from 'rollup-plugin-postcss';
import json from "@rollup/plugin-json";

let root = "../../../../";

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
				rollup.verbump(root+"app/etc/version"),
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
				json(),
				// postcss({
				// 	plugins: []
				// }),
				production && terser()
			]
		}
	}
}

const production = !process.env.ROLLUP_WATCH;


export default
	rollup.compiler(
		'src/index.ts',
		production ? root+'dev/assets/~admin' : root+'app/public/~admin', 'index.js', 'index.css', production)