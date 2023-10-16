import './bootstrap';
import Alpine from 'alpinejs';
import Import from './Alpine/Import';

window.Alpine = Alpine;
window.Alpine.data('Import', Import);
window.Alpine.start();
