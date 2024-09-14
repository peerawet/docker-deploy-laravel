import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard';
import mask from '@alpinejs/mask';
import intersect from '@alpinejs/intersect';
import persist from '@alpinejs/persist';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import anchor from '@alpinejs/anchor';
import morph from '@alpinejs/morph';

Alpine.plugin(Clipboard, mask, intersect, persist, focus, collapse, anchor, morph);

Livewire.start();
