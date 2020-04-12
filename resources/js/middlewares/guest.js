/** None Authenticated users */


export default function guest({ next, store }) {

    console.log('guest middleware running');
    console.log('store: ' + store);

      // If there is a token
      if ( store.getters["auth/token"] ) {

          return next({ name: "home" }); // redirect user to home

      } else {

          return next(); // continue request

      }
  }
  