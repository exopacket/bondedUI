import { createSSRApp } from 'vue'
import { renderToString } from 'vue/server-renderer'

export async function html(flags) {

    if(flags.data) {

        const data = flags.data;

        const jsonObj = JSON.parse(data);
        const templateHtml = jsonObj.template;
        const templateData = jsonObj.data;

        const app = createSSRApp({
            template: templateHtml,
            data: () => templateData,
        })

        return await renderToString(app)

    }
}
