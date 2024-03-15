export default {
    modules: [
        {
            name: 'Example', // The name of the Alpine component. Ex: Alpine.data('Example', () => ...)
            path: Zermatt.Variables.viewUrl + '/zermatt/modules/example.js' // The file exporting Alpine data
        }
    ],
    rewrites: [
        {
            name: 'Example', // the name of the module to rewrite
            path: Zermatt.Variables.viewUrl + '/zermatt/modules/rewrite.js', // The rewrite file
        }
    ]
}
