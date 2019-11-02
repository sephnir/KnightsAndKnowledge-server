import React from "react";
import ReactDOM from "react-dom";

class NavIcon extends React.Component {
    constructor(props) {
        super(props);

        this.renderIcon = this.renderIcon.bind(this);

        this.state = {
            iconLink: props.icon,
            iconText: props.text,
            iconHref: props.href
        };
    }

    renderIcon() {
        return (
            <a class="nav-link text-light" href={this.state.iconHref}>
                <img src={this.state.iconLink} alt={this.state.iconText} />
                <br />
                {this.state.iconText}
            </a>
        );
    }

    render() {
        return this.renderIcon();
    }
}

if (document.getElementsByClassName("ReactNavIcon")) {
    Array.from(document.getElementsByClassName("ReactNavIcon")).forEach(
        function(element, index, array) {
            const props = Object.assign({}, element.dataset);
            ReactDOM.render(<NavIcon {...props} />, element);
        }
    );
}
