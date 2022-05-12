import React from "react";

const GridItem = ({id, title, content, author}) => {

    const {email, authorId, name, username, website} = author;

    return(<>
        <div className="card">
            <div className="card-header">
                Creado El && Nombre Author
            </div>
            <div className="card-body">
                <h5 className="card-title">{title}</h5>
                <p className="card-text">{content}</p>
                <a href="#" className="btn btn-primary">Ver Author</a>
            </div>
        </div>
    </>);
}

export default GridItem;