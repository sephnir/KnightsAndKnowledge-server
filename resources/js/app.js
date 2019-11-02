// app.js

require("./bootstrap");
import React from "react";
import { render } from "react-dom";
import { BrowserRouter, Route } from "react-router-dom";

import Master from "./components/Master";
import CreateItem from "./components/CreateItem";

render(
    <BrowserRouter>
        <Route path="/" component={Master} />
        <Route path="/add-item" component={CreateItem} />
    </BrowserRouter>,
    document.getElementById("example")
);
