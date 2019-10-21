import VueRouter from 'vue-router';

let routes = [
  {
    path: '/',
    component: require('./components/Home.vue').default
  },
  {
    path: '/games',
    component: require('./components/Games.vue').default
  },
  {
    path: '/schedule',
    component: require('./components/Schedule.vue').default
  },
  {
    path: '/register',
    component: require('./components/auth/Register.vue').default
  },
  {
    path: '/login',
    component: require('./components/auth/Login.vue').default
  }
];

export default new VueRouter({
  routes,
  linkActiveClass: 'is-active'
});