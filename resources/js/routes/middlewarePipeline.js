/** Execute multiple middlewares if we have an more than one(array) middlwares */


function middlewarePipeline(context, middleware, index) {
    
    const nextMiddleware = middleware[index];

    // Check if there is another middleware
    if ( !nextMiddleware ) {

        return context.next // continue request

    }

    return () => {

        const nextPipeline = middlewarePipeline(context, middleware, index+1)
        nextMiddleware({...context, next: nextPipeline})

    }

}

export default middlewarePipeline;