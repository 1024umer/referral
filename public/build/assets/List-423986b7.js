import{d as b}from"./default-4d824ecd.js";import{S as g}from"./sweetalert2.all-d78efc0d.js";import{_ as I,e as k,w as e,r as i,o as w,a as t,d as u,t as p,b as x,n as C}from"./app-426106b2.js";const f=new b("users"),B=new b("roles"),D={data(){return{roles:[],role_id:0,breadcrumbs:[{title:"Dashboard",to:{name:"auth.panel"},disabled:!1,exact:!0},{title:"Users",exact:!0,disabled:!0,to:{name:"auth.users.listing"}}],serverItems:[],totalItems:0,loading:!1,itemsPerPage:10,search:"",headers:[{title:"ID",align:"start",sortable:!0,key:"id"},{title:"Email",align:"start",sortable:!0,key:"email"},{title:"Name",align:"start",sortable:!0,key:"full_name"},{title:"State",align:"start",sortable:!0,key:"state"},{title:"Date of Birth",align:"start",sortable:!0,key:"dob"},{title:"Enrolled",align:"start",sortable:!0,key:"is_active"},{title:"Actions",sortable:!1,key:"actions"}]}},methods:{async loadItems({page:r,itemsPerPage:l,sortBy:n}){this.loading=!0,this.serverItems=[];var o="";o+="?page="+r;try{n.length>0&&(o+="&sortCol="+n[0].key,o+="&sortByDesc="+n[0].order)}catch{}o+="&perpage="+l,this.search!=""&&(o+="&search="+this.search),this.role_id>0&&(o+="&role_id="+this.role_id);const s=await f.getlist(o);this.serverItems=s.data;try{this.totalItems=s.meta.total}catch{this.totalItems=0}this.loading=!1},async deleteItem(r){await g.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then(n=>{if(n.isConfirmed)return!0})&&(await f.delete({id:r}),g.fire("Deleted!","Your record has been deleted.","success"),this.loadItems({page:1,itemsPerPage:10}))}},watch:{$route(){this.loadItems({page:1,itemsPerPage:10})},itemsPerPage(){this.loadItems({page:1,itemsPerPage:10})},search(){this.loadItems({page:1,itemsPerPage:10})},role_id(){this.loadItems({page:1,itemsPerPage:10})}},async mounted(){const r=await B.getlist("").then(l=>l.data);this.roles=[{id:0,title:"All"},...r],this.loadItems({page:1,itemsPerPage:10})}},U=u("mdi-forward"),V=u("Add User");function N(r,l,n,o,s,d){const _=i("v-icon"),v=i("v-breadcrumbs"),c=i("v-col"),m=i("v-btn"),y=i("v-text-field"),h=i("v-row"),P=i("v-data-table-server");return w(),k(h,null,{default:e(()=>[t(c,null,{default:e(()=>[t(v,{items:s.breadcrumbs},{prepend:e(()=>[t(_,{size:"small",icon:"mdi-home-city"})]),divider:e(()=>[t(_,null,{default:e(()=>[U]),_:1})]),_:1},8,["items"])]),_:1}),t(c,{cols:"1"},{default:e(()=>[t(m,{color:"success",link:"",to:{name:"auth.users.add"}},{default:e(()=>[V]),_:1},8,["to"])]),_:1}),t(c,{cols:"12"},{default:e(()=>[t(h,null,{default:e(()=>[t(c,null,{default:e(()=>[t(y,{modelValue:s.search,"onUpdate:modelValue":l[0]||(l[0]=a=>s.search=a),label:"Search","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1})]),_:1}),t(P,{"items-per-page":s.itemsPerPage,"onUpdate:items-per-page":l[1]||(l[1]=a=>s.itemsPerPage=a),headers:s.headers,"items-length":s.totalItems,items:s.serverItems,loading:s.loading,"item-value":"id","loading-text":"Loading","onUpdate:options":d.loadItems},{"item.role_id":e(({item:a})=>[u(p(a.selectable.role.title),1)]),"item.is_active":e(({item:a})=>[x("div",{class:C({"green-background":a.selectable.is_active===1,"red-background":a.selectable.is_active!==1})},p(a.selectable.is_active===1?"Yes":"No"),3)]),"item.actions":e(({item:a})=>[t(m,{link:"",to:{name:"auth.users.edit",params:{id:a.selectable.id}},color:"info",density:"comfortable",size:"small",icon:"mdi-pencil-plus"},null,8,["to"]),t(m,{onClick:S=>d.deleteItem(a.selectable.id),color:"error",density:"comfortable",size:"small",icon:"mdi-delete-outline"},null,8,["onClick"])]),_:1},8,["items-per-page","headers","items-length","items","loading","onUpdate:options"])]),_:1})]),_:1})}const E=I(D,[["render",N]]);export{E as default};
