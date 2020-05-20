import React from 'react';
import {Switch, Route} from 'react-router-dom';
import SignUp from "./pages/auth/SignUp";
import Home from "./pages/home/Home";
import SignIn from "./pages/auth/SignIn";

export default () => {
    return (
        <Switch>
            <Route exact path='/'>
                <Home/>
            </Route>
            <Route exact path='/sign-up'>
                <SignUp/>
            </Route>
            <Route exact path='/sign-in'>
                <SignIn/>
            </Route>
        </Switch>
    );
}