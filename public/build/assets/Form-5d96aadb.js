import{d as h}from"./default-59bf48ce.js";import{C as V,U as x}from"./ckeditor-adapter-8431b299.js";import{_ as w,e as U,w as r,r as s,o as k,a as i,b as y,d as c,t as C,f as D}from"./app-cc8f7264.js";const n=new h("events"),E={data(){return{editor:V,editorConfig:{extraPlugins:[function(t){t.plugins.get("FileRepository").createUploadAdapter=e=>new x(e)}]},breadcrumbs:[{title:"Dashboard",to:{name:"auth.panel"},disabled:!1,exact:!0},{title:"Event",exact:!0,disabled:!1,to:{name:"auth.events.listing"}}],form:{title:"",time:"",date:"",description:"",location:"",image:void 0,is_active:!0,id:0},loading:!1,errors:{title:[],time:[],date:[],location:[],description:[],image:[]}}},methods:{async insertRecord(){this.resetErrors(),this.loading=!0;var t=new FormData;if(t.append("title",this.form.title),t.append("location",this.form.location),t.append("date",this.form.date),t.append("time",this.form.time),this.form.image&&t.append("image",this.form.image[0]),t.append("description",this.form.description),t.append("is_active",this.form.is_active==!0?1:0),this.form.id>0){t.append("id",this.form.id);var e=await n.update(t,this.form.id)}else var e=await n.create(t);e.status?this.$router.push({name:"auth.events.listing"}):(e.data.title&&(this.errors.title=e.data.title),e.data.description&&(this.errors.description=e.data.description),e.data.date&&(this.errors.date=e.data.date),e.data.time&&(this.errors.time=e.data.time),e.data.location&&(this.errors.location=e.data.location),e.data.image&&(this.errors.image=e.data.image)),this.loading=!1},resetErrors(){this.errors={description:[],long_description:[],iamge:[],title:[],slug:[]}}},watch:{},async mounted(){if(this.$route.params.id){this.form.id=this.$route.params.id,this.breadcrumbs.push({title:"Edit",exact:!0,disabled:!0,to:{name:"auth.events.add",params:{id:this.$route.params.id}}});var t=await n.get(this.$route.params.id);this.form={title:t.title?t.title:"",description:t.description?t.description:"",date:t.date?t.date:"",time:t.time?t.time:"",location:t.location?t.location:"",is_active:t.is_active!=0,image:t.image?t.image:"",id:this.$route.params.id}}else this.breadcrumbs.push({title:"Add",exact:!0,disabled:!0,to:{name:"auth.events.add"}})}},q=c("mdi-forward");function A(t,e,R,T,o,p){const m=s("v-icon"),f=s("v-breadcrumbs"),l=s("v-col"),d=s("v-text-field"),g=s("v-file-input"),_=s("ckeditor"),v=s("v-checkbox"),b=s("v-btn"),u=s("v-row");return k(),U(u,null,{default:r(()=>[i(l,{cols:"12"},{default:r(()=>[i(f,{items:o.breadcrumbs},{prepend:r(()=>[i(m,{size:"small",icon:"mdi-home-city"})]),divider:r(()=>[i(m,null,{default:r(()=>[q]),_:1})]),_:1},8,["items"])]),_:1}),i(l,{cols:"12"},{default:r(()=>[y("form",{onSubmit:e[7]||(e[7]=D((...a)=>t.submit&&t.submit(...a),["prevent"]))},[i(u,null,{default:r(()=>[i(l,{cols:"6"},{default:r(()=>[i(d,{modelValue:o.form.title,"onUpdate:modelValue":e[0]||(e[0]=a=>o.form.title=a),counter:255,label:"Title",required:"","error-messages":o.errors.title},null,8,["modelValue","error-messages"])]),_:1}),i(l,{cols:"6"},{default:r(()=>[i(g,{accept:"image/*",modelValue:o.form.image,"onUpdate:modelValue":e[1]||(e[1]=a=>o.form.image=a),label:"Thumbnail"},null,8,["modelValue"])]),_:1}),i(l,{cols:"12",sm:"12",md:"12"},{default:r(()=>[i(_,{editor:o.editor,modelValue:o.form.description,"onUpdate:modelValue":e[2]||(e[2]=a=>o.form.description=a),config:o.editorConfig},null,8,["editor","modelValue","config"])]),_:1}),i(l,{cols:"6"},{default:r(()=>[i(d,{modelValue:o.form.location,"onUpdate:modelValue":e[3]||(e[3]=a=>o.form.location=a),counter:255,label:"Loaction",required:"","error-messages":o.errors.location},null,8,["modelValue","error-messages"])]),_:1}),i(l,{cols:"3"},{default:r(()=>[i(d,{type:"date",modelValue:o.form.date,"onUpdate:modelValue":e[4]||(e[4]=a=>o.form.date=a),counter:255,label:"Date",required:"","error-messages":o.errors.date},null,8,["modelValue","error-messages"])]),_:1}),i(l,{cols:"3"},{default:r(()=>[i(d,{type:"time",modelValue:o.form.time,"onUpdate:modelValue":e[5]||(e[5]=a=>o.form.time=a),counter:255,label:"Time",required:"","error-messages":o.errors.time},null,8,["modelValue","error-messages"])]),_:1}),i(l,{cols:"3"},{default:r(()=>[i(v,{modelValue:o.form.is_active,"onUpdate:modelValue":e[6]||(e[6]=a=>o.form.is_active=a),label:"Is Active?"},null,8,["modelValue"])]),_:1}),i(l,{cols:"12"},{default:r(()=>[i(b,{onClick:p.insertRecord,disabled:o.loading,loading:o.loading,"loading-text":o.form.id>0?"Updating":"Inserting",color:"success"},{default:r(()=>[c(C(o.form.id>0?"Update":"Insert")+" Record",1)]),_:1},8,["onClick","disabled","loading","loading-text"])]),_:1})]),_:1})],32)]),_:1})]),_:1})}const N=w(E,[["render",A]]);export{N as default};
