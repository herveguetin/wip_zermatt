export default {
    modules: [
        {
            name: 'Welcome', // The name of the Alpine component. Ex: Alpine.data('Example', () => ...)
            path: Zermatt.Variables.viewUrl + '/zermatt/modules/welcome.js' // The file exporting Alpine data
        }
    ],
    rewrites: [
        {
            name: 'Welcome', // the name of the module to rewrite
            path: Zermatt.Variables.viewUrl + '/zermatt/modules/welcome-rewrite.js', // The rewrite file
        }
    ]
}
