import { createStore } from 'vuex'
// Create a new store instance.
import axios from 'axios';
const store = createStore({
    state() {
        return {
            authtoken: '',
            loggedIn: false,
            sideBarStatus: false,
            loggedInUser: {},
            notificationStatus: false,
            notificationText: '',
            permissions: [],
            isPanelFull: false,
            drawerState: false,
            leadSources: [
                {id: 1, text: 'Called in', color: 'danger'},
                {id: 2, text: 'Referral (Branch Manager / Lead Caller)', color: 'warning'},
                {id: 3, text: 'Walk-In', color: 'yellow'},
                {id: 4, text: 'Website', color: 'success'},
                {id: 5, text: 'Others', color: 'info'},
                {id: 6, text: 'Google Ads', color: 'info'},
                {id: 7, text: 'Facebook Ads', color: 'info'},
                {id: 8, text: 'Debt Leads (Paid)', color: 'info'},
                {id: 9, text: 'Google Search', color: 'info'},
                {id: 10, text: 'Live Chat', color: 'info'},
                {id: 11, text: 'Google My Business (Chat)', color: 'info'},
                {id: 12, text: 'Repeat Client', color: 'info'},
            ],
            countries: [
                {
                    value: 'CA',
                    text: 'Canada',
                    states: [ 
                        { text: 'Alberta', value: 'AB' }, { text: 'British Columbia', value: 'BC' }, { text: 'Manitoba', value: 'MB' }, { text: 'New Brunswick', value: 'NB' }, { text: 'Newfoundland and Labrador', value: 'NL' }, { text: 'Northwest Territories', value: 'NT' }, { text: 'Nova Scotia', value: 'NS' }, { text: 'Nunavut', value: 'NU' }, { text: 'Ontario', value: 'ON' }, { text: 'Prince Edward Island', value: 'PE' }, { text: 'Quebec', value: 'QC' }, { text: 'Saskatchewan', value: 'SK' }, { text: 'Yukon Territory', value: 'YT' } 
                    ]
                },
                {
                    value: 'US',
                    text: 'United States',
                    states: [
                        { value: "AK", text: "Alaska" },
                        { value: "AL", text: "Alabama" },
                        { value: "AR", text: "Arkansas" },
                        { value: "AS", text: "American Samoa" },
                        { value: "AZ", text: "Arizona" },
                        { value: "CA", text: "California" },
                        { value: "CO", text: "Colorado" },
                        { value: "CT", text: "Connecticut" },
                        { value: "DC", text: "District of Columbia" },
                        { value: "DE", text: "Delaware" },
                        { value: "FL", text: "Florida" },
                        { value: "GA", text: "Georgia" },
                        { value: "GU", text: "Guam" },
                        { value: "HI", text: "Hawaii" },
                        { value: "IA", text: "Iowa" },
                        { value: "ID", text: "Idaho" },
                        { value: "IL", text: "Illinois" },
                        { value: "IN", text: "Indiana" },
                        { value: "KS", text: "Kansas" },
                        { value: "KY", text: "Kentucky" },
                        { value: "LA", text: "Louisiana" },
                        { value: "MA", text: "Massachusetts" },
                        { value: "MD", text: "Maryland" },
                        { value: "ME", text: "Maine" },
                        { value: "MI", text: "Michigan" },
                        { value: "MN", text: "Minnesota" },
                        { value: "MO", text: "Missouri" },
                        { value: "MS", text: "Mississippi" },
                        { value: "MT", text: "Montana" },
                        { value: "NC", text: "North Carolina" },
                        { value: "ND", text: "North Dakota" },
                        { value: "NE", text: "Nebraska" },
                        { value: "NH", text: "New Hampshire" },
                        { value: "NJ", text: "New Jersey" },
                        { value: "NM", text: "New Mexico" },
                        { value: "NV", text: "Nevada" },
                        { value: "NY", text: "New York" },
                        { value: "OH", text: "Ohio" },
                        { value: "OK", text: "Oklahoma" },
                        { value: "OR", text: "Oregon" },
                        { value: "PA", text: "Pennsylvania" },
                        { value: "PR", text: "Puerto Rico" },
                        { value: "RI", text: "Rhode Island" },
                        { value: "SC", text: "South Carolina" },
                        { value: "SD", text: "South Dakota" },
                        { value: "TN", text: "Tennessee" },
                        { value: "TX", text: "Texas" },
                        { value: "UT", text: "Utah" },
                        { value: "VA", text: "Virginia" },
                        { value: "VI", text: "Virgin Islands" },
                        { value: "VT", text: "Vermont" },
                        { value: "WA", text: "Washington" },
                        { value: "WI", text: "Wisconsin" },
                        { value: "WV", text: "West Virginia" },
                        { value: "WY", text: "Wyoming" }
                    ]
                },
            ],
            genders: [
                {value: 'M', text: 'Male'},
                {value: 'F', text: 'Female'},
            ],
            followupMessages: [
                "Unable to reach lead",
                "Number just rings - no answer",
                "Client is Unavailable - try again later",
                "Bad Timing - Call back",
                "Busy Signal",
                "Number Not in Service/Not Assigned",
                "Reached Voicemail - left message",
                "Reached Voicemail is full - couldn't leave a message",
                "Reached Voicemail - did not leave a message",
                "Voicemail Not Initialized",
                "Cannot Receive Incoming Calls"
            ],
            fileTypes: [],
            sidebarCounts: {
                myAppointments: 0,
            },
            leadStatuses:[
                {name: 'New', id: 1, bgClass: 'bg-blue-darken-2', forGrid: true},
                {name: 'Pending', id: 2, bgClass: 'bg-blue-darken-4', forGrid: true},
                {name: 'DNC', id: 3, bgClass: 'bg-red-darken-4', forGrid: true},
                {name: 'Booked Appointment', id: 4, bgClass: 'bg-teal-darken-4', forGrid: true},
                {name: 'ANS(Appointment No Show)', id: 5, bgClass: 'bg-teal-darken-2', forGrid: true},
                {name: 'Initial Done', id: 6, bgClass: 'bg-teal-lighten-2', forGrid: true},
                {name: 'Sign-up Scheduled', id: 7, bgClass: 'bg-pink-darken-2', forGrid: true},
                {name: 'Sign-up No Show', id: 8, bgClass: 'bg-blue-lighten-2', forGrid: true},
                {name: 'Signed won', id: 9, bgClass: 'bg-blue-lighten-2', forGrid: true},
                {name: "Number just rings - no answer", id: 10 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Client is Unavailable - try again later", id: 11 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Bad Timing - Call back", id: 12 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Busy Signal", id: 13 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Wrong Number", id: 14 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Number Not in Service/Not Assigned", id: 15 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Reached Voicemail - left message", id: 16 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Reached Voicemail - couldn't leave a message", id: 17 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Reached Voicemail - did not leave a message", id: 18 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Voicemail Not Initialized", id: 19 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Cannot received incoming calls", id: 20 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Email Sequence Ended, No Response", id: 21 , bgClass: 'bg-red-darken-4', forGrid: false},
                {name: "Do not Contact - lost (too much equity)", id: 22 , bgClass: 'bg-red-darken-4', forGrid: false},
            ],
            priorities: [
                { name: 'None', id: 0 },
                { name: 'Low', id: 1, color: 'green' },
                { name: 'Medium', id: 2, color: 'blue' },
                { name: 'High', id: 3, color: 'red' },
            ]
        }
    },
    mutations: {
        updateDrawer(state, val){
            state.drawerState = val
        },
        setPanelFull(state, val){
            state.isPanelFull = val
        },
        setAuthToken(state, authtoken) {
            localStorage.setItem('auth_token',authtoken);
            try{
                axios.defaults.headers.common['Authorization'] = 'Bearer '+authtoken;
            }catch(ex){}
            state.authtoken = authtoken
        },
        setLoginStatus(state, loggedIn) {
            state.loggedIn = loggedIn
        },
        setloggedInUser(state, loggedInUser){
            localStorage.setItem('logged_in_role_id',loggedInUser.role_id);
            state.loggedInUser = loggedInUser
        },
        setSideBarStatus(status, sideBarStatus){
            status.sideBarStatus = sideBarStatus
        },
        setPermissions(state, permissions){
            state.permissions = permissions
        },
        setNotification(state, text){
            state.notificationText = text
            state.notificationStatus = true
            setTimeout(()=>{
                state.notificationStatus = false
            },1000)
        },
        setFileTypes(state, data){
            state.fileTypes = data
        }
    },
    getters: {
        drawerState(state){
            return state.drawerState
        },
        wallets(state){
            return state.wallets
        },
        authtoken(state) {
            return state.authtoken
        },
        loggedIn(state) {
            return state.loggedIn
        },
        isPanelFull(state){
            return state.isPanelFull
        },
        loggedInUser(state){
            return state.loggedInUser
        },
        sideBarStatus(state){
            return state.sideBarStatus
        },
        notificationStatus(state){
            return state.notificationStatus
        },
        notificationText(state){
            return state.notificationText
        },
        getPermissions(state){
            return state.permissions
        },
        getLeadSources(state){
            return state.leadSources
        },
        getCountries(state){
            return state.countries
        },
        getGenders(state){
            return state.genders
        },
        getFollowupMessages(state){
            return state.followupMessages
        }
        ,
        getFileTypes(state){
            return state.fileTypes
        },
        getLeadStatuses(state){
            return state.leadStatuses
        },
        getPriorities(state){
            return state.priorities
        }
    }
})
export default store