import{d as l}from"./default-59bf48ce.js";import{_ as b,e as g,w as o,r as a,o as q,a as t,b as V,d as v,t as x,f as k}from"./app-cc8f7264.js";const U=new l("surveys"),C=new l("surveys-questions"),d=new l("surveys-answers"),D={data(){return{surveys:[],categories:[],otherVideos:[],breadcrumbs:[{title:"Dashboard",to:{name:"auth.panel"},disabled:!1,exact:!0},{title:"Answer",exact:!0,disabled:!1,to:{name:"auth.surveyanswers.listing"}}],form:{survey_id:[],answer:"",is_correct:!0,survey_question_id:[],id:0},loading:!1,errors:{survey_id:[],survey_question_id:[],answer:[]}}},methods:{async insertRecord(){this.resetErrors(),this.loading=!0;var s=new FormData;if(s.append("answer",this.form.answer),s.append("survey_id",this.form.survey_id),s.append("survey_question_id",this.form.survey_question_id),s.append("is_correct",this.form.is_correct==!0?1:0),this.form.id>0){s.append("id",this.form.id);var e=await d.update(s,this.form.id)}else var e=await d.create(s);e.status?this.$router.push({name:"auth.surveyanswers.listing"}):(e.data.survey_id&&(this.errors.survey_id=e.data.survey_id),e.data.survey_question_id&&(this.errors.survey_question_id=e.data.survey_question_id),e.data.answer&&(this.errors.answer=e.data.answer)),this.loading=!1},resetErrors(){this.errors={survey_id:[],survey_question_id:[],answer:[]}}},watch:{},async mounted(){if(this.surveys=await U.getlist("").then(e=>e.data.map(u=>({id:u.id,name:u.name}))),this.categories=await C.getlist("").then(e=>e.data.map(u=>({id:u.id,question:u.question}))),this.otherVideos=await d.getlist("").then(e=>e.data),this.$route.params.id){this.form.id=this.$route.params.id,this.breadcrumbs.push({title:"Edit",exact:!0,disabled:!0,to:{name:"auth.surveyanswers.add",params:{id:this.$route.params.id}}});var s=await d.get(this.$route.params.id);this.form={answer:s.answer?s.answer:"",survey_id:s.question.survey.name?s.question.survey.name:"",survey_question_id:s.question.question?s.question.question:"",is_correct:s.is_correct!=0,id:this.$route.params.id}}else this.breadcrumbs.push({title:"Add",exact:!0,disabled:!0,to:{name:"auth.surveyanswers.add"}})}},A=v("mdi-forward");function B(s,e,u,E,r,f){const m=a("v-icon"),p=a("v-breadcrumbs"),n=a("v-col"),y=a("v-text-field"),_=a("v-select"),h=a("v-checkbox"),w=a("v-btn"),c=a("v-row");return q(),g(c,null,{default:o(()=>[t(n,{cols:"12"},{default:o(()=>[t(p,{items:r.breadcrumbs},{prepend:o(()=>[t(m,{size:"small",icon:"mdi-home-city"})]),divider:o(()=>[t(m,null,{default:o(()=>[A]),_:1})]),_:1},8,["items"])]),_:1}),t(n,{cols:"12"},{default:o(()=>[V("form",{onSubmit:e[4]||(e[4]=k((...i)=>s.submit&&s.submit(...i),["prevent"]))},[t(c,null,{default:o(()=>[t(n,{cols:"6"},{default:o(()=>[t(y,{modelValue:r.form.answer,"onUpdate:modelValue":e[0]||(e[0]=i=>r.form.answer=i),counter:255,label:"Answer",required:"","error-messages":r.errors.answer},null,8,["modelValue","error-messages"])]),_:1}),t(n,{cols:"6"},{default:o(()=>[t(_,{"error-messages":r.errors.survey_id,"item-text":"name","item-title":"name","item-value":"id",label:"Survey",items:r.surveys,modelValue:r.form.survey_id,"onUpdate:modelValue":e[1]||(e[1]=i=>r.form.survey_id=i)},null,8,["error-messages","items","modelValue"])]),_:1}),t(n,{cols:"6"},{default:o(()=>[t(_,{"error-messages":r.errors.survey_question_id,"item-text":"question","item-title":"question","item-value":"id",label:"Question",items:r.categories,modelValue:r.form.survey_question_id,"onUpdate:modelValue":e[2]||(e[2]=i=>r.form.survey_question_id=i)},null,8,["error-messages","items","modelValue"])]),_:1}),t(n,{cols:"3"},{default:o(()=>[t(h,{modelValue:r.form.is_correct,"onUpdate:modelValue":e[3]||(e[3]=i=>r.form.is_correct=i),label:"Is Correct?"},null,8,["modelValue"])]),_:1}),t(n,{cols:"12"},{default:o(()=>[t(w,{onClick:f.insertRecord,disabled:r.loading,loading:r.loading,"loading-text":r.form.id>0?"Updating":"Inserting",color:"success"},{default:o(()=>[v(x(r.form.id>0?"Update":"Insert")+" Record",1)]),_:1},8,["onClick","disabled","loading","loading-text"])]),_:1})]),_:1})],32)]),_:1})]),_:1})}const R=b(D,[["render",B]]);export{R as default};
