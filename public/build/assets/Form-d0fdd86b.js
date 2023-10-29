import{d as C}from"./default-b9ad43f8.js";import{_ as U,e as k,w as a,r as n,o as d,a as s,b as E,c as _,f as b,d as v,t as N,g as q}from"./app-783ada3e.js";const w=new C("profiles"),x={data(){return{roles:[],breadcrumbs:[{title:"Dashboard",to:{name:"auth.panel"},disabled:!1,exact:!0},{title:"Users",exact:!0,disabled:!1,to:{name:"auth.users.listing"}}],form:{name:"",email:"",password:"",image:[],signature:[],id:0},loading:!1,errors:{name:[],email:[],password:[],image:[],signature:[]}}},methods:{async insertRecord(){this.resetErrors(),this.loading=!0;var e=new FormData;e.append("name",this.form.name),e.append("email",this.form.email),this.form.id>0&&e.append("id",this.form.id);const o=this.form.password!==void 0?this.form.password:"";o!==""&&e.append("password",o),this.form.image&&this.form.image.length>0&&e.append("image",this.form.image[0]),this.form.signature&&this.form.signature.length>0&&e.append("signature",this.form.signature[0]);try{var t=await w.update(e,this.form.id);t.status?this.$router.push({name:"auth.users.listing"}):(t.data.name&&(this.errors.name=t.data.name),t.data.email&&(this.errors.email=t.data.email),t.data.image&&(this.errors.image=t.data.image),t.data.signature&&(this.errors.signature=t.data.signature),t.data.password&&(this.errors.password=t.data.password))}catch(u){console.error(u)}this.loading=!1},onFileChange(e){this.form.thumbnail=e.target.files[0]},resetErrors(){this.errors={name:[],email:[],password:[],image:[],signature:[]}}},watch:{},async mounted(){try{const e=await w.get();this.res=e,this.form={name:e.name?e.name:"",email:e.email?e.email:"",role_id:e.role_id?e.role_id:"",id:e.id?e.id:0},this.form.id>0&&this.breadcrumbs.push({title:"Edit",exact:!0,disabled:!0,to:{name:"auth.users.add",params:{id:this.form.id}}})}catch(e){console.error(e)}}},B=v("mdi-forward"),D={key:0},F={key:0};function I(e,o,t,u,r,f){const g=n("v-icon"),V=n("v-breadcrumbs"),l=n("v-col"),m=n("v-text-field"),p=n("v-file-input"),c=n("v-img"),y=n("v-btn"),h=n("v-row");return d(),k(h,null,{default:a(()=>[s(l,{cols:"12"},{default:a(()=>[s(V,{items:r.breadcrumbs},{prepend:a(()=>[s(g,{size:"small",icon:"mdi-home-city"})]),divider:a(()=>[s(g,null,{default:a(()=>[B]),_:1})]),_:1},8,["items"])]),_:1}),s(l,{cols:"12"},{default:a(()=>[E("form",{onSubmit:o[5]||(o[5]=q((...i)=>e.submit&&e.submit(...i),["prevent"]))},[s(h,null,{default:a(()=>[s(l,{cols:"6"},{default:a(()=>[s(m,{modelValue:r.form.name,"onUpdate:modelValue":o[0]||(o[0]=i=>r.form.name=i),counter:255,label:"Name",required:"","error-messages":r.errors.name},null,8,["modelValue","error-messages"])]),_:1}),s(l,{cols:"6"},{default:a(()=>[s(m,{modelValue:r.form.email,"onUpdate:modelValue":o[1]||(o[1]=i=>r.form.email=i),counter:255,label:"Email",required:"","error-messages":r.errors.email},null,8,["modelValue","error-messages"])]),_:1}),s(l,{cols:"12"},{default:a(()=>[s(m,{modelValue:r.form.password,"onUpdate:modelValue":o[2]||(o[2]=i=>r.form.password=i),label:"Password",type:"password","error-messages":r.errors.password},null,8,["modelValue","error-messages"])]),_:1}),s(l,{cols:"6"},{default:a(()=>[s(p,{modelValue:r.form.image,"onUpdate:modelValue":o[3]||(o[3]=i=>r.form.image=i),counter:255,label:"Profile Image",required:"","error-messages":r.errors.image,onChange:f.onFileChange},null,8,["modelValue","error-messages","onChange"]),e.res&&e.res.image?(d(),_("div",D,[s(c,{height:"25%",width:"25%",alt:"Avatar",src:e.res.image_url},null,8,["src"])])):b("",!0)]),_:1}),s(l,{cols:"6"},{default:a(()=>[s(p,{modelValue:r.form.signature,"onUpdate:modelValue":o[4]||(o[4]=i=>r.form.signature=i),label:"Signature",required:"","error-messages":r.errors.signature},null,8,["modelValue","error-messages"]),e.res&&e.res.signature?(d(),_("div",F,[s(c,{height:"50%",width:"50%",alt:"Avatar",src:e.res.signature.full_url},null,8,["src"])])):b("",!0)]),_:1}),s(l,{cols:"12"},{default:a(()=>[s(y,{onClick:f.insertRecord,disabled:r.loading,loading:r.loading,"loading-text":r.form.id>0?"Updating":"Inserting",color:"success"},{default:a(()=>[v(N(r.form.id>0?"Update":"Insert")+" Record",1)]),_:1},8,["onClick","disabled","loading","loading-text"])]),_:1})]),_:1})],32)]),_:1})]),_:1})}const A=U(x,[["render",I]]);export{A as default};
