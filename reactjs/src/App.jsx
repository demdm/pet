import React from 'react';
import Router from "./Router";
import './App.css';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost/api';

export default () => {
  return (
    <div className="App">
      <Router/>
    </div>
  );
}