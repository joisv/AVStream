import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'
import collapse from '@alpinejs/collapse'
import persist from '@alpinejs/persist'
import Plyr from 'plyr';

window.Alpine = Alpine;
window.player = new Plyr('#player');

Alpine.plugin(focus)
Alpine.plugin(collapse)
Alpine.plugin(persist)

Alpine.store('modal', {
    on: false,
 
    toggle() {
        this.on = ! this.on
    }
})
Alpine.start();
