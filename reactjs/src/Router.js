import React from 'react';
import {Switch, Route} from 'react-router-dom';
import SignUp from "./pages/auth/SignUp";
import Home from "./pages/home/Home";

export default () => {
    return (
        <Switch>
            <Route exact path='/'>
                <Home/>
            </Route>
            <Route exact path='/sign-up'>
                <SignUp/>
            </Route>
        </Switch>
    );
}