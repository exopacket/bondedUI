import args from "args"
import {html} from "./renderer.js"

args
    .option('data', 'JSON input for component data.')

const flags = args.parse(process.argv)

console.log(await html(flags))