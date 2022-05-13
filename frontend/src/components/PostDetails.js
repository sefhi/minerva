// Home.js
import React from 'react'
import {useParams} from "react-router";

const PostDetails = () => {

    const {id} = useParams();
    const item = localStorage.getItem(id);
    const post = JSON.parse(item);

    const {title, content, author, createdAt} = post;
    const {username, email, name, website} = author;

    return (<>
        <div className={"card"}>
            <div className={"card-body"}>
                <h4 className={"card-title"}>{title}</h4>
                <p className={"card-text"}>{content}</p>
                <a href="#" className="btn btn-primary">Volver al Blog</a>
                <p className="card-text mt-3"><small className="text-muted">Creado el {createdAt}</small></p>
            </div>
        </div>
        <div className="card">
            <ul className="list-group list-group-flush">
                <li className="list-group-item">Creado por: <strong>{username}</strong></li>
                <li className="list-group-item">Nombre: <strong>{name}</strong> </li>
                <li className="list-group-item">Email: <strong>{email}</strong> </li>
                <li className="list-group-item">Web: <strong>{website}</strong></li>
            </ul>
        </div>
    </>);
}

export default PostDetails