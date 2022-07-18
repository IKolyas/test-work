import AdCreate from "./components/AdCreate";
import AdList from "./components/AdList";
import AdShow from "./components/AdShow";

export const routes = [
    { path: '/create', component: AdCreate, name: 'AdCreate' },
    { path: '/', component: AdList, name: 'AdList' },
    { path: '/show/:adId', component: AdShow, name: 'AdShow', props: true }
];
