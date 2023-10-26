import{d as p}from"./default-59bf48ce.js";import{C as y,U as C}from"./ckeditor-adapter-8431b299.js";import{S as u}from"./sweetalert2.all-8a4b642f.js";import{_ as U,e as k,w as s,r as a,o as R,a as o,b as S,d as f,t as A,f as D}from"./app-cc8f7264.js";const E=new p("case-categories"),d=new p("case-studies"),F={data(){return{editor:y,editorConfig:{extraPlugins:[function(t){t.plugins.get("FileRepository").createUploadAdapter=e=>new C(e)}]},categories:[],otherVideos:[],breadcrumbs:[{title:"Dashboard",to:{name:"auth.panel"},disabled:!1,exact:!0},{title:"Case Study",exact:!0,disabled:!1,to:{name:"auth.cases.listing"}}],form:{case_categories_ids:[],title:"",slug:"",description:"",long_description:"",image:void 0,is_active:!0,id:0},loading:!1,errors:{case_categories_ids:[],description:"",slug:"",long_description:"",title:[]}}},methods:{async insertRecord(){this.resetErrors(),this.loading=!0;var t=new FormData;if(t.append("title",this.form.title),this.form.image&&t.append("image",this.form.image[0]),t.append("description",this.form.description),t.append("long_description",this.form.long_description),t.append("slug",this.form.slug),t.append("case_categories_ids",JSON.stringify(this.form.case_categories_ids)),t.append("is_active",this.form.is_active==!0?1:0),this.form.id>0){t.append("id",this.form.id);var e=await d.update(t,this.form.id)}else var e=await d.create(t);e.status||(e.data.title&&(this.errors.title=e.data.title),e.data.slug&&(this.errors.slug=e.data.slug),e.data.description&&(this.errors.description=e.data.description),e.data.case_categories_ids&&(this.errors.case_categories_ids=e.data.case_categories_ids),e.data.long_description&&(this.errors.long_description=e.data.long_description),e.data.image&&(this.errors.image=e.data.image),await u.fire({icon:"error",title:"Error",text:"Please Fill Form Correctly"})),e.status&&(await u.fire({icon:"success",title:this.form.id>0?"Record Updated":"Record Created",text:this.form.id>0?"Record updated successfully.":"Record created successfully."}),this.$router.push({name:"auth.cases.listing"})),this.loading=!1},resetErrors(){this.errors={case_categories_ids:[],image:[],slug:[],description:[],long_description:[],title:[]}}},watch:{"form.title":function(){var t=this.form.title;t=t.toLowerCase(),t=t.replace(/[^a-zA-Z0-9]+/g,"-"),this.form.slug=t}},async mounted(){if(this.categories=await E.getlist("").then(e=>e.data),this.otherVideos=await d.getlist("").then(e=>e.data),this.$route.params.id){this.form.id=this.$route.params.id,this.breadcrumbs.push({title:"Edit",exact:!0,disabled:!0,to:{name:"auth.cases.add",params:{id:this.$route.params.id}}});var t=await d.get(this.$route.params.id);this.form={title:t.title?t.title:"",slug:t.slug?t.slug:"",image:t.image?t.image:"",description:t.description?t.description:"",long_description:t.long_description?t.long_description:"",case_categories_ids:t.case_categories_ids?JSON.parse(t.case_categories_ids):[],is_active:t.is_active!=0,id:this.$route.params.id}}else this.breadcrumbs.push({title:"Add",exact:!0,disabled:!0,to:{name:"auth.cases.add"}})}},N=f("mdi-forward");function T(t,e,z,B,i,g){const n=a("v-icon"),_=a("v-breadcrumbs"),l=a("v-col"),c=a("v-text-field"),h=a("v-file-input"),v=a("v-select"),b=a("v-textarea"),V=a("ckeditor"),w=a("v-checkbox"),x=a("v-btn"),m=a("v-row");return R(),k(m,null,{default:s(()=>[o(l,{cols:"12"},{default:s(()=>[o(_,{items:i.breadcrumbs},{prepend:s(()=>[o(n,{size:"small",icon:"mdi-home-city"})]),divider:s(()=>[o(n,null,{default:s(()=>[N]),_:1})]),_:1},8,["items"])]),_:1}),o(l,{cols:"12"},{default:s(()=>[S("form",{onSubmit:e[7]||(e[7]=D((...r)=>t.submit&&t.submit(...r),["prevent"]))},[o(m,null,{default:s(()=>[o(l,{cols:"6"},{default:s(()=>[o(c,{modelValue:i.form.title,"onUpdate:modelValue":e[0]||(e[0]=r=>i.form.title=r),counter:255,label:"Title",required:"","error-messages":i.errors.title},null,8,["modelValue","error-messages"])]),_:1}),o(l,{cols:"6"},{default:s(()=>[o(c,{modelValue:i.form.slug,"onUpdate:modelValue":e[1]||(e[1]=r=>i.form.slug=r),counter:255,label:"Slug",required:"","error-messages":i.errors.slug},null,8,["modelValue","error-messages"])]),_:1}),o(l,{cols:"6"},{default:s(()=>[o(h,{accept:"image/*",modelValue:i.form.image,"onUpdate:modelValue":e[2]||(e[2]=r=>i.form.image=r),label:"Thumbnail"},null,8,["modelValue"])]),_:1}),o(l,{cols:"6"},{default:s(()=>[o(v,{multiple:"","error-messages":i.errors.case_categories_ids,"item-title":"name","item-value":"id",label:"Category",items:i.categories,modelValue:i.form.case_categories_ids,"onUpdate:modelValue":e[3]||(e[3]=r=>i.form.case_categories_ids=r)},null,8,["error-messages","items","modelValue"])]),_:1}),o(l,{cols:"6"},{default:s(()=>[o(b,{counter:255,label:"Description","no-resize":"",rows:"1",modelValue:i.form.description,"onUpdate:modelValue":e[4]||(e[4]=r=>i.form.description=r)},null,8,["modelValue"])]),_:1}),o(l,{cols:"12",sm:"12",md:"12"},{default:s(()=>[o(V,{editor:i.editor,modelValue:i.form.long_description,"onUpdate:modelValue":e[5]||(e[5]=r=>i.form.long_description=r),config:i.editorConfig},null,8,["editor","modelValue","config"])]),_:1}),o(l,{cols:"3"},{default:s(()=>[o(w,{modelValue:i.form.is_active,"onUpdate:modelValue":e[6]||(e[6]=r=>i.form.is_active=r),label:"Is Active?"},null,8,["modelValue"])]),_:1}),o(l,{cols:"12"},{default:s(()=>[o(x,{onClick:g.insertRecord,disabled:i.loading,loading:i.loading,"loading-text":i.form.id>0?"Updating":"Inserting",color:"success"},{default:s(()=>[f(A(i.form.id>0?"Update":"Insert")+" Record",1)]),_:1},8,["onClick","disabled","loading","loading-text"])]),_:1})]),_:1})],32)]),_:1})]),_:1})}const P=U(F,[["render",T]]);export{P as default};
