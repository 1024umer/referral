import{d as v}from"./default-59bf48ce.js";import"./sweetalert2.all-8a4b642f.js";import{_ as b,e as P,w as s,r as i,o as I,a as t,d as _,t as y}from"./app-cc8f7264.js";const x=new v("chooseus"),k={data(){return{roles:[],role_id:0,breadcrumbs:[{title:"Dashboard",to:{name:"auth.panel"},disabled:!1,exact:!0},{title:"Why Choose Us",exact:!0,disabled:!0,to:{name:"auth.chooseus.listing"}}],serverItems:[],totalItems:0,loading:!1,itemsPerPage:10,search:"",headers:[{title:"ID",align:"start",sortable:!0,key:"id"},{title:"Title",align:"start",sortable:!0,key:"title"},{title:"Description",align:"start",sortable:!0,key:"description"},{title:"Actions",sortable:!1,key:"actions"}]}},methods:{async loadItems({page:m,itemsPerPage:l,sortBy:r}){this.loading=!0,this.serverItems=[];var o="";o+="?page="+m;try{r.length>0&&(o+="&sortCol="+r[0].key,o+="&sortByDesc="+r[0].order)}catch{}o+="&perpage="+l,this.search!=""&&(o+="&search="+this.search),this.role_id>0&&(o+="&role_id="+this.role_id);const e=await x.getlist(o);this.serverItems=e.data;try{this.totalItems=e.meta.total}catch{this.totalItems=0}this.loading=!1}},watch:{$route(){this.loadItems({page:1,itemsPerPage:10})},itemsPerPage(){this.loadItems({page:1,itemsPerPage:10})},search(){this.loadItems({page:1,itemsPerPage:10})},role_id(){this.loadItems({page:1,itemsPerPage:10})}},async mounted(){this.loadItems({page:1,itemsPerPage:10})}},w=_("mdi-forward");function D(m,l,r,o,e,d){const c=i("v-icon"),h=i("v-breadcrumbs"),n=i("v-col"),u=i("v-text-field"),p=i("v-row"),g=i("v-btn"),f=i("v-data-table-server");return I(),P(p,null,{default:s(()=>[t(n,null,{default:s(()=>[t(h,{items:e.breadcrumbs},{prepend:s(()=>[t(c,{size:"small",icon:"mdi-home-city"})]),divider:s(()=>[t(c,null,{default:s(()=>[w]),_:1})]),_:1},8,["items"])]),_:1}),t(n,{cols:"1"}),t(n,{cols:"12"},{default:s(()=>[t(p,null,{default:s(()=>[t(n,null,{default:s(()=>[t(u,{modelValue:e.search,"onUpdate:modelValue":l[0]||(l[0]=a=>e.search=a),label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1})]),_:1}),t(f,{"items-per-page":e.itemsPerPage,"onUpdate:items-per-page":l[1]||(l[1]=a=>e.itemsPerPage=a),headers:e.headers,"items-length":e.totalItems,items:e.serverItems,loading:e.loading,"item-value":"id","loading-text":"Loading","onUpdate:options":d.loadItems},{"item.role_id":s(({item:a})=>[_(y(a.selectable.role.title),1)]),"item.actions":s(({item:a})=>[t(g,{link:"",to:{name:"auth.chooseus.edit",params:{id:a.selectable.id}},color:"info",density:"comfortable",size:"small",icon:"mdi-pencil-plus"},null,8,["to"])]),_:1},8,["items-per-page","headers","items-length","items","loading","onUpdate:options"])]),_:1})]),_:1})}const z=b(k,[["render",D]]);export{z as default};
