import{U as v,p as y}from"./index-5875a7cc.js";function b(o,c){for(var t=0;t<c.length;t++){const e=c[t];if(typeof e!="string"&&!Array.isArray(e)){for(const r in e)if(r!=="default"&&!(r in o)){const n=Object.getOwnPropertyDescriptor(e,r);n&&Object.defineProperty(o,r,n.get?n:{enumerable:!0,get:()=>e[r]})}}}return Object.freeze(Object.defineProperty(o,Symbol.toStringTag,{value:"Module"}))}var m={exports:{}};(function(o,c){(function(t,e){o.exports=e()})(y,function(){var t={LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"};return function(e,r,n){var s=r.prototype,M=s.format;n.en.formats=t,s.format=function(i){i===void 0&&(i="YYYY-MM-DDTHH:mm:ssZ");var l=this.$locale().formats,p=function(d,f){return d.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g,function(x,Y,a){var L=a&&a.toUpperCase();return Y||f[a]||t[a]||f[L].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g,function(j,g,D){return g||D.slice(1)})})}(i,l===void 0?{}:l);return M.call(this,p)}}})})(m);var u=m.exports;const h=v(u),z=b({__proto__:null,default:h},[u]);export{z as l};
//# sourceMappingURL=localizedFormat-7cd4f7c5.js.map
