import fs from "fs";
import svelte from 'rollup-plugin-svelte';
import commonjs from '@rollup/plugin-commonjs';
import resolve from '@rollup/plugin-node-resolve';
import {terser} from 'rollup-plugin-terser';
import sveltePreprocess from 'svelte-preprocess';
import typescript from "rollup-plugin-typescript2";
import css from 'rollup-plugin-css-only';
import json from "@rollup/plugin-json";

let root = '../../'

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
				json(),
				svelte({
					emitCss: true,
					preprocess: sveltePreprocess({sourceMap: !production}),
					compilerOptions: {
						dev: !production,
						cssHash: ({hash, css, name, filename}) => 'Q' + hash(css)
					}
				}),
				css({output: outCSS}),
				resolve(),
				commonjs(),
				this.verbump(root + 'var/etc/version'),
				production && terser()
			]
		}
	}
}

const production = !process.env.ROLLUP_WATCH;


export default rollup.compiler(
	root + 'frontend/admin/src/index.ts',
	production ? root + 'assets/public/~admin' : root + 'var/public/~admin',
	'index.js',
	'index.css',
	production
);