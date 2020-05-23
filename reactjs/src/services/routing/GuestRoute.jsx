import React from 'react';
import {Redirect, Route} from "react-router-dom";
import {isAuthenticated} from "../security/Identifier";

function GuestRoute({ children, ...rest }) {
    return (
        <Route
            {...rest}
            render={({ location }) => isAuthenticated()
                ? (
                    <Redirect
                        to={{
                            pathname: "/",
                            state: { from: location }
                        }}
                    />
                )
                : (
                    children
                )
            }
        />
    );
}

export default GuestRoute;