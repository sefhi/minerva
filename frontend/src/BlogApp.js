import React from "react";
import GridPost from "./components/GridPost";
import {
    Link, BrowserRouter as Router, Route, Routes
} from "react-router-dom";
import PostDetails from "./components/PostDetails";

const BlogApp = () => {

    return (<>

        <div className={"container"}>

            <Router>
                <div>
                    <nav className="navbar navbar-expand-lg navbar-light bg-light">
                        <ul className="nav">
                            <li>
                                <Link className="nav-link" to={"/"}>Blog</Link>
                            </li>
                        </ul>
                    </nav>
                    <Routes>
                        <Route path={"/"} element={<GridPost/>}>
                        </Route>
                        <Route exact path="/post/:id" element={<PostDetails/>}>
                        </Route>
                    </Routes>
                </div>

            </Router>
        </div>

    </>)
};

export default BlogApp;