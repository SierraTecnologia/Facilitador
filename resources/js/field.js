Nova.booting((Vue) => {
    Vue.component("index-select-auto-complete", () => import(/* webpackChunkName: "index-select-auto-complete" */ "./components/Index"))
    Vue.component("detail-select-auto-complete", () => import(/* webpackChunkName: "detail-select-auto-complete" */ "./components/Detail"))
    Vue.component("form-select-auto-complete", () => import(/* webpackChunkName: "form-select-auto-complete" */ "./components/Form"))
})
Nova.booting((Vue, router) => {
    Vue.component('index-radio-field', require('./components/radio-field/IndexField'));
    Vue.component('detail-radio-field', require('./components/radio-field/DetailField'));
    Vue.component('form-radio-field', require('./components/radio-field/FormField'));
})
Nova.booting((Vue, router) => {
    Vue.component('index-nova-money-field', require('./components/nova-money-field/IndexField').default);
    Vue.component('detail-nova-money-field', require('./components/nova-money-field/DetailField').default);
    Vue.component('form-nova-money-field', require('./components/nova-money-field/FormField').default);
})
