export default {
    modules: [
        {
            name: 'Test',
            path: Zermatt.Variables.viewUrl + '/zermatt/modules/test.js'
        }
    ],
    rewrites: [
        {
            name: 'Test',
            path: Zermatt.Variables.viewUrl + '/Magento_Theme/zermatt/modules/theme.js',
        }
    ]
}
