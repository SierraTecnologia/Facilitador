(window.wpJsonpSelectAutoComplete=window.wpJsonpSelectAutoComplete||[]).push([[3],{4:function(e,t,n){"use strict";n.r(t);var s={props:["resourceName","field"],computed:{selectedValue:function(){var e=this;if(void 0!==this.field.displayUsingLabels&&!0===this.field.displayUsingLabels){var t=this.field.options.find((function(t){return Number(t.value)===Number(e.field.value)}));return t?String(t.label):""}return String(this.field.value)}}},i=n(6),o=Object(i.a)(s,(function(){var e=this.$createElement,t=this._self._c||e;return this.field.asHtml?t("div",{domProps:{innerHTML:this._s(this.selectedValue)}}):t("span",{staticClass:"whitespace-no-wrap"},[this._v(this._s(this.selectedValue))])}),[],!1,null,null,null);t.default=o.exports},6:function(e,t,n){"use strict";function s(e,t,n,s,i,o,r,l){var a,u="function"==typeof e?e.options:e;if(t&&(u.render=t,u.staticRenderFns=n,u._compiled=!0),s&&(u.functional=!0),o&&(u._scopeId="data-v-"+o),r?(a=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),i&&i.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(r)},u._ssrRegister=a):i&&(a=l?function(){i.call(this,this.$root.$options.shadowRoot)}:i),a)if(u.functional){u._injectStyles=a;var d=u.render;u.render=function(e,t){return a.call(t),d(e,t)}}else{var c=u.beforeCreate;u.beforeCreate=c?[].concat(c,a):[a]}return{exports:e,options:u}}n.d(t,"a",(function(){return s}))}}]);