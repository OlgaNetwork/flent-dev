import{g,c as h}from"./worker-8065324c.js";function x(e,c){return c.forEach(function(r){r&&typeof r!="string"&&!Array.isArray(r)&&Object.keys(r).forEach(function(t){if(t!=="default"&&!(t in e)){var o=Object.getOwnPropertyDescriptor(r,t);Object.defineProperty(e,t,o.get?o:{enumerable:!0,get:function(){return r[t]}})}})}),Object.freeze(e)}var s={exports:{}};(function(e,c){(function(r,t){e.exports=t()})(h,function(){var r={LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"};return function(t,o,u){var i=o.prototype,M=i.format;u.en.formats=r,i.format=function(n){n===void 0&&(n="YYYY-MM-DDTHH:mm:ssZ");var f=this.$locale().formats,p=function(Y,m){return Y.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g,function(b,d,a){var L=a&&a.toUpperCase();return d||m[a]||r[a]||m[L].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g,function(j,v,D){return v||D.slice(1)})})}(n,f===void 0?{}:f);return M.call(this,p)}}})})(s);var l=s.exports,y=g(l),z=x({__proto__:null,default:y},[l]);export{z as l};
//# sourceMappingURL=localizedFormat-909da070.js.map
