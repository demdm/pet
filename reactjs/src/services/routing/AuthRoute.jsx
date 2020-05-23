import React from 'react';
import {Redirect, Route} from "react-router-dom";
import {isAuthenticated} from "../security/Identifier";

function AuthRoute({ children, ...rest }) {
    return (
        <Route
            {...rest}
            render={({ location }) => isAuthenticated()
                ? (
                    children
                )
                : (
                    <Redirect
                        to={{
                            pathname: "/sign-in",
                            state: { from: location }
                        }}
                    />
                )
            }
        />
    );
}

export default AuthRoute;