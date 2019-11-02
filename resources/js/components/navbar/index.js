import React from "react";
import ReactDOM from "react-dom";

import NavIcon from "./navicon";

import s from "./navbar.scss";

import logo from "../../../img/logo.svg";
import loginIcon from "../../../img/icon/login.svg";
import regisIcon from "../../../img/icon/register.svg";

import { withRouter } from "react-router-dom";

class Navbar extends React.Component {
    constructor(props) {
        super(props);

        this.renderNavbar = this.renderNavbar.bind(this);
        this.login = this.login.bind(this);
        this.register = this.register.bind(this);
        this.logout = this.logout.bind(this);

        this.state = {
            appName: props.appname,
            csrfToken: props.csrftoken,

            name: props.name,
            homeUrl: props.homeurl,

            loginUrl: props.loginurl,
            loginText: props.logintext,

            logoutUrl: props.logouturl,
            logoutText: props.logouttext,

            regisUrl: props.regisurl,
            regisText: props.registext,

            logoutEid: "logout-form"
        };
    }

    login() {
        window.location.href = this.state.loginUrl;
    }

    register() {
        window.location.href = this.state.regisUrl;
    }

    logout() {
        let eid = "#" + this.state.logoutEid;
        $(eid).submit();
    }

    renderNavbar() {
        let loginIconJSX;
        let registerIconJSX;

        if (this.state.name == undefined || this.state.name == "") {
            loginIconJSX = (
                <li className="nav-item">
                    <NavIcon
                        icon={loginIcon}
                        text={this.state.loginText}
                        callback={this.login}
                    ></NavIcon>
                </li>
            );

            if (this.state.regisUrl != undefined && this.state.regisUrl != "") {
                registerIconJSX = (
                    <li className="nav-item">
                        <NavIcon
                            icon={regisIcon}
                            text={this.state.regisText}
                            callback={this.register}
                        ></NavIcon>
                    </li>
                );
            }
        } else {
            loginIconJSX = (
                <li className="nav-item dropdown">
                    <NavIcon
                        icon={loginIcon}
                        text={this.state.logoutText}
                        callback={this.logout}
                    ></NavIcon>
                </li>
            );
        }

        return (
            <nav className="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
                <div className="container">
                    <a
                        className="navbar-brand text-light"
                        href={this.state.homeUrl}
                    >
                        <img src={logo} alt={this.state.appName} />
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div
                        className="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        {/* Left Side Of Navbar */}
                        <ul className="navbar-nav mr-auto"></ul>

                        {/* Right Side Of Navbar */}
                        <ul className="navbar-nav ml-auto">
                            {/* Authentication Links */}
                            {loginIconJSX}
                            {registerIconJSX}
                        </ul>
                        <form
                            id="logout-form"
                            action={this.state.logoutUrl}
                            method="POST"
                            style={{ display: "hidden" }}
                        >
                            <input
                                type="hidden"
                                name="_token"
                                value={this.state.csrfToken}
                            ></input>
                        </form>
                    </div>
                </div>
            </nav>
        );
    }

    render() {
        return this.renderNavbar();
    }
}

if ($("#ReactNavBar")) {
    let element = $("#ReactNavBar")[0];

    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<Navbar {...props} />, element);
}

export default Navbar;
