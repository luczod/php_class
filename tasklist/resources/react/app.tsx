import React from "react";
import ReactDOM from "react-dom/client";
import Main from "./Main";
import "./index.css";

const divRoot = document.getElementById("app") as HTMLElement;

ReactDOM.createRoot(divRoot).render(<Main />);
