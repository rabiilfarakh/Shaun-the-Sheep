import { defineStore } from "pinia";
import axios from "axios";

export const AuthStore = defineStore("AuthStore", {
  state: () => ({
    user: "nnnull",
  }),
  
  actions: {
    async signUp(formData) {
      try {
        const res = await axios.post("/api/register", formData);
        console.log(res);
      } catch (error) {
        console.error(error);
      }
    },
    async signIn(formData) {
      try {
        const res = await axios.post("/api/login", formData);
        if (res.data.token) {
          localStorage.setItem("token", res.data.token);
          this.user = res.data.user;
          // Send token in GET method
          await this.fetchUserData();
          return this.user;
        }
      } catch (error) {
        console.error("Error during login:", error);
      }
    },
    async signOut() {
      localStorage.removeItem('token');
      this.user = null;
    },
    async fetchUserData() {
      try {
        const token = localStorage.getItem("token");
        if (token) {
          const res = await axios.get("/api/user", {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          console.log(res.data);
          this.user = res.data.user;
        }
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    }
  },
});
