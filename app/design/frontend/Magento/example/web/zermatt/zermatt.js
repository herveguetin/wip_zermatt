import Config from './zermatt-lock.json'
import Zermatt from 'zermatt-core'

// Import new AlpineJS plugins
import anchor from '@alpinejs/anchor'
import resize from '@alpinejs/resize'

// Use AlpineJS plugins on Zermatt init.
Zermatt.Event.on('zermatt:init', () => Alpine.plugin(anchor, resize))

Zermatt.init(Config)
