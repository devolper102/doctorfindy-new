import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex, axios);

export default new Vuex.Store({
  state: {
    specialities: [],
    doctors: [],
    hospitals: [],
    diseases: [],
    laboratories: [],
    services: []
  },
  actions: {
    // Specialities
    getSpecialities({commit}) {
      axios
        .get("/all-spec", {})
        .then(response => {
          let specialities = response.data;
          commit("SET_Specialities", specialities);
        })
        .catch(error => {
          // eslint-disable-next-line
          
        });
    },
      // Doctors
    getDoctors({commit}) {
      axios
        .get("/all-docs", {})
        .then(response => {
          let doctors = response.data;
          commit("SET_doctors", doctors);
        })
        .catch(error => {
          // eslint-disable-next-line
        });
    },
      // Hospitals
    getHospitals({commit}) {
      axios
        .get("/all-hosp", {})
        .then(response => {
          let hospitals = response.data;
          commit("SET_Hospitals", hospitals);
        })
        .catch(error => {
          // eslint-disable-next-line
        });
    },
      // Diseases
    getDiseases({commit}) {
      axios
        .get("/all-dise", {})
        .then(response => {
          let diseases = response.data;
          commit("SET_Diseases", diseases);
        })
        .catch(error => {
          // eslint-disable-next-line
        });
    },
      // Laboratories
    getLaboratories({commit}) {
      axios
        .get("/all-labs", {})
        .then(response => {
          let laboratories = response.data;
          commit("SET_Laboratories", laboratories);
        })
        .catch(error => {
          // eslint-disable-next-line
        });
    },
      // Services
    getServices({commit}) {
      axios
        .get("/all-services", {})
        .then(response => {
          let services = response.data;
          commit("SET_Services", services);
        })
        .catch(error => {
          // eslint-disable-next-line
        });
    }
  },
  getters: {
    specialitiesData: specialities => state.specialities,
    doctorsData: doctors => state.doctors,
    hospitalsData: hospitals => state.hospitals,
    diseasesData: diseases => state.diseases,
    laboratoriesData: laboratories => state.laboratories,
    servicesData: services => state.services,
    // need to change this to filter to only have computers that match the current site id
    // Can we derive the current id from this.$route.params.siteID?
    computerData: state => state.computers,
    //something like this?
    getComputerbyID: (state, id) => (id) => {
      return state.computers.find(computer => computer.Site === site.id)
    }

  },
  mutations: {
    SET_SITES(state, sites) {
      state.sites = sites;
    },
    SET_COMPUTERS(state, computers) {
      state.computers = computers;
    }
  },
  computed: {
  sites() {
    return this.$store.getters.siteData;
  },
  computers() {
    return this.$store.getters.computerData;
  }
},
created(){
  
},
});