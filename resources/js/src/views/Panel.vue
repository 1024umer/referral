<template>
  <v-row>
    <v-col cols="12">
      <v-row>
        <v-col>
          <v-text-field prepend-inner-icon="mdi-magnify" v-model="search"
            label="Search Leads By First Name, Last Name, Email, Phone" variant="underlined"></v-text-field>
        </v-col>
          <v-col>
              <v-select item-title="name" item-value="id" label="Leads Status" :items="leadStatuses" v-model="lead_id"></v-select>
          </v-col>
      </v-row>
      <v-data-table-server v-model:items-per-page="itemsPerPage" :headers="headers" :items-length="totalItems"
        :items="serverItems" :loading="loading" item-value="id" loading-text="Loading" @update:options="loadItems">
        <template v-slot:item.user_id="{ item }">
          <user-avatar :user="item.selectable.user" @click.native="openModal(item.selectable.user)" />
        </template>
        <template v-slot:item.lead_status="{ item }">
          {{leadStatuses.find(e=>e.id==item.selectable.lead_status).name}}
        </template>
        <template v-slot:item.client_id="{ item }">
            <v-badge v-if="item.selectable.client_id==0" color="error" content="No" inline></v-badge>
            <v-badge v-else color="success" content="Yes" inline></v-badge>
        </template>
        <template v-slot:item.full_name="{ item }">
            <!-- <router-link target="_blank" :to="{ name: 'auth.leads.grid', query: { lead_id: item.selectable.id } }">{{ item.selectable.full_name }}</router-link> -->
            <v-btn @click="showLeadPopupNew(item.selectable)" class="text-decoration-underline" variant="plain">
              {{ item.selectable.full_name }}
            </v-btn>
        </template>
        <template v-slot:item.email="{ item }">
            {{ item.selectable.email }}
        </template>
      </v-data-table-server>
    </v-col>
    <v-dialog v-model="modalOpen" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">User Information</v-card-title>
        <v-card-text>
          <v-row>
            <v-col>
              <v-col cols="12">
                <v-select item-title="name" item-value="id" label="User*" :items="users"
                  v-model="form.user_id"></v-select>
              </v-col>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeModal">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="updateContactOwner">Update</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <LeadPopupModalNew @refreshLead="refreshLastLead" :templates="leadPopup.leadData.templates" @openLastLead="leadPopup.dialog=true" @closeLead="leadPopup.dialog=false" :dialog="leadPopup.dialog" :lead="leadPopup.leadData" />
  </v-row>
</template>
<style scoped>
.no-print .v-toolbar{
    top: 0px !important;
}
</style>
<script>
import service from "@services/auth/default";
const userservice = new service('users')
import Swal from "sweetalert2";
export default {
  computed: {
    user() {
      return this.$store.getters.loggedInUser;
    },
    leadStatuses(){
      return [{
        name: 'All',
        id: 0,
        bgClass: '',
        forGrid: false,
      },...this.$store.getters.getLeadStatuses]
    },
  },
  components: {
    UserAvatar,
    LeadPopupModalNew
  },
  data() {
    return {
      lead_id:0,
      leadPopup:{
        dialog: false,
        leadData: {},
      },
      serverItems: [],
      totalItems: 0,
      loading: false,
      itemsPerPage: 10,
      search: '',
      headers: [
        {
          title: "ID",
          align: "start",
          sortable: true,
          key: "id",
        },
        {
          title: "Full Name",
          align: "start",
          sortable: true,
          key: "name",
        },
        {
          title: "Email",
          align: "start",
          sortable: true,
          key: "email",
        },
        
      
       
       
      ],
      modalOpen: false,
      selectedUser: null,
      selectedContactOwner: null,
      contactOwners: [],
      users: [],
      form: {
        user_id: null,
      },
    }
  },
  methods: {
    async refreshLastLead(){
      const lead = await itemtypeservice.get(this.leadPopup.leadData.id)
      this.showLeadPopupNew(lead)
    },
    async showLeadPopupNew(leadData){
      const lead = await itemtypeservice.get(leadData.id)
      const activities = await otherrequestservice.get('leads/'+lead.id+'/activities').then(e=>e.data.activities)
      let templates = await templateservice.getlist('?lead_id='+lead.id).then(e=>e.data);
      const templatesData = [{id: 0, name: 'No Template'},...templates]
      this.leadPopup.dialog = true;
      this.leadPopup.leadData = lead;
      this.leadPopup.leadData.activities = activities
      this.leadPopup.leadData.templates = templatesData
    },
    async fetchContactOwners() {
      try {
        const usersData = await userservice.getlist();
        this.users = usersData.data;
      } catch (error) {
        console.error("Error fetching users:", error);
      }
    },

    openModal(user) {
      this.selectedUser = user;
      this.selectedContactOwner = user?.user_id || null;
      this.form.user_id = this.selectedContactOwner;
      this.modalOpen = true;
    },

    closeModal() {
      this.selectedUser = null;
      this.selectedContactOwner = null;
      this.modalOpen = false;
    },
    async updateContactOwner() {
      this.closeModal();
    },
    async loadItems({ page, itemsPerPage, sortBy }) {
      this.loading = true;
      this.serverItems = []
      var query = "";
      query += "?page=" + page;
      try {
        if (sortBy.length > 0) {
          let sortCol = sortBy[0].key
          if (sortCol = 'updated_at_formatted') {
            sortCol = 'updated_at';
          }
          query += "&sortCol=" + sortCol;
          query += "&sortByDesc=" + sortBy[0].order;
        }
      } catch (ex) { }
      query += "&perpage=" + itemsPerPage;
      if(this.lead_id>0){
        query += "&lead_status=" + this.lead_id;
      }
      if (this.search != "") {
        query += "&search=" + this.search;
      }
      if(!this.$route.query.is_client){
        // query += "&is_client=1";
        query += "&getall=true";
      }
      const data = await itemtypeservice.getlist(query);
      this.serverItems = data.data;
      try {
        this.totalItems = data.meta.total;
      } catch (ex) {
        this.totalItems = 0
      }
      this.loading = false;
    },
  },
  watch: {
    $route() {
      if(this.$route.query.lead_status){
        if(parseInt(this.$route.query.lead_status)>0){
          this.lead_id = parseInt(this.$route.query.lead_status)
        }else{
          this.lead_id = 0
        }
      }else{
        this.lead_id = 0
      }
      this.loadItems({ page: 1, itemsPerPage: 10 });
    },
    itemsPerPage() {
      this.loadItems({ page: 1, itemsPerPage: 10 });
    },
    search() {
      this.loadItems({ page: 1, itemsPerPage: 10 });
    },
    lead_id(){
      this.loadItems({ page: 1, itemsPerPage: 10 });
    }
  },
  async mounted() {
    await this.fetchContactOwners();
    this.loadItems({ page: 1, itemsPerPage: 10 });
    if(this.$route.query.lead_id){
      if(parseInt(this.$route.query.lead_id)>0){
        var lId = this.$route.query.lead_id
        itemtypeservice.get(lId).then(e=>{
            this.showLeadPopupNew(e)
        })
      }
    }
    if(this.$route.query.lead_status){
      if(parseInt(this.$route.query.lead_status)>0){
        this.lead_id = parseInt(this.$route.query.lead_status)
      }
    }
  },
}
</script>
