import Config from './zermatt.config.js'
import Alpine from 'alpinejs'
import Zermatt from 'zermatt-core'

window.Zermatt = Zermatt
window.Alpine = Alpine

Zermatt.Module.loadAll(Config)
    .then(modules => {
        modules.map(module => Alpine.data(module.name, () => module.default))
        Alpine.start()
    }).catch(error => {
        console.error('An error occurred:', error)
    }
)
