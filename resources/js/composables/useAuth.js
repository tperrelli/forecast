import axios from 'axios';
import { ref, computed, reactive } from "vue"

const state = reactive({
  authenticated: false,
  user: {}
});

export default function useAuth() {

  const authenticated = computed(() => state.authenticated);
  const user = computed(() => state.user);

  const setAuthenticated = (authenticated) => {
    state.authenticated = authenticated;
  };

  const setUser = (user) => {
    state.user = user;
  };

  const login = async (credentials) => {
    
    await axios.get('/sanctum/csrf-cookie');

    try {
      
      await axios.post('/login', credentials);
      return attempt();

    } catch (e) {}
  };

  const attempt = async () => {
    
    try {
      const response = await axios.get('/api/user');

      setAuthenticated(true);
      setUser(response.data);

      return response;
      
    } catch (e) {
      setAuthenticated(false);
      setUser({});
    }
  };

  const logout = async () => {
    
    try {

      await axios.post('/logout');

    } catch (e) {
      setAuthenticated(false);
      setUser({});
    }
  }

  return {
    user,
    authenticated,
    login,
    logout,
    attempt,
    setUser,
    setAuthenticated
  }
}