/** 
 * Login user automatically if he has logged in before (already exist in database)
 */

export default function checkAuth({next}, store) {

    console.log('checkAuth middleware running');
    


    // If the user is not logged in & there is a token stored in cookies
    if ( !store.getters['auth/check'] && store.getters['auth/token'] ) {

        store.dispatch('auth/fetchUser'); // Fech user by token
        return next();

    } else if ( store.getters['auth/check'] && store.getters['auth/token'] ) { // If the user logged in & there is a token stored in cookies

        return next(); // continue request (go to dashboard)
        
    } else {

        return next( {name: 'login'} ); // redirect user to login page

    }

}