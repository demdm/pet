import React from 'react';
import {Switch, Route} from 'react-router-dom';
import SignUp from "../../pages/auth/SignUp";
import Home from "../../pages/home/Home";
import SignIn from "../../pages/auth/SignIn";
import GuestRoute from "./GuestRoute";

export default () => (
    <Switch>
        <Route exact path='/'>
            <Home/>
        </Route>
        <GuestRoute exact path='/sign-up'>
            <SignUp/>
        </GuestRoute>
        <Route exact path='/sign-in'>
            <SignIn/>
        </Route>
    </Switch>
);