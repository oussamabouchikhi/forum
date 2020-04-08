/** Dashboard Middleware (only authenticated users have access to dashboard) */

export default function auth({next}, store) {

    console.log('auth middleware running');
    


    // If the user is not logged in
    if ( !store.getters['auth/check'] ) 
        return next( {name: 'login'} ); // redirect user to login page
    else
        return next(); // continue request (go to dashboard)

}