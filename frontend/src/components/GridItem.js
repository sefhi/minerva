import React from "react";
import {Link} from "react-router-dom";
import {generatePath} from "react-router";

const GridItem = ({id, title, content, createdAt, author}) => {

    const {username} = author;
    localStorage.setItem(id, JSON.stringify({id, title, content, createdAt, author}));
    const url = generatePath("/post/:id", {id: id});
    return(<>
        <div className="card">
            <div className="card-header">
                Creado por <strong>{username}</strong> el {createdAt}
            </div>
            <div className="card-body">
                <h5 className="card-title">{title}</h5>
                <p className="card-text">{content}</p>
                <Link to={url} className="btn btn-primary">Ir al Post</Link>
            </div>
        </div>
    </>);
}

export default GridItem;