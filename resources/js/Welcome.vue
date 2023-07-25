<template>
  <div class="w-64 mx-auto mt-8">
    <div class="mb-4">
      <label class="block text-gray-700">Make:</label>
      <input
        type="text"
        v-model="make"
        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-indigo-500"
      />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700">Model:</label>
      <input
        type="text"
        v-model="model"
        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-indigo-500"
      />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700">Registration:</label>
      <input
        type="text"
        v-model="registration"
        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-indigo-500"
      />
    </div>
    <button
      @click="search"
      class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
    >
      Search
    </button>
 
    <button
      @click="clearInput"
      class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-4"
    >
      Clear
    </button>

    

    <div v-if="!loading && vehicles.length > 0" class="mt-4">
      <table class="w-full table-auto border-collapse">
        <thead>
          <tr>
            <th class="px-4 py-2">Make</th>
            <th class="px-4 py-2">Model</th>
            <th class="px-4 py-2">Registration</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="vehicle in vehicles" :key="vehicle.id" class="text-gray-700 mb-2">
            <td class="border px-4 py-2">{{ vehicle.make }}</td>
            <td class="border px-4 py-2">{{ vehicle.model }}</td>
            <td class="border px-4 py-2">{{ vehicle.registration }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>



<script>
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  setup() {
    const vehicles = ref([]); // Define vehicles as a reactive ref with an empty array

    const make = ref("");
    const model = ref("");
    const registration = ref("");
    const loading = ref(false);
    const searchPerformed = ref(false);

    const search = () => {
      // Error handling for wrong data input
      if (!make.value || !model.value || !registration.value) {
        Swal.fire({
          icon: "error",
          title: "Invalid Input",
          text: "Please provide values for Make, Model, and Registration.",
        });
        return;
      }

      loading.value = true;
      searchPerformed.value = true;
      axios
        .get("http://localhost/api/vehicles", {
          params: {
            make: make.value,
            model: model.value,
            registration: registration.value,
          },
        })
        .then((response) => {
          vehicles.value = response.data; // Update the reactive ref with the response data
          loading.value = false; // Set loading to false after the data is fetched

          // Show alert if no results found
          if (vehicles.value.length === 0) {
            Swal.fire({
              icon: "warning",
              title: "No Results",
              text: "No vehicles found with the specified criteria.",
            });
          }
        })
        .catch((error) => {
          console.error(error);
          loading.value = false; // Set loading to false on error
        });
    };

    const clearInput = () => {
      make.value = "";
      model.value = "";
      registration.value = "";
      vehicles.value = []; // Reset the vehicles array when input is cleared
    };

    return {
      make,
      model,
      registration,
      vehicles,
      loading,
      searchPerformed,
      search,
      clearInput,
    };
  },
};
</script>
