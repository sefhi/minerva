import React from "react";
import useFetchPost from "../hooks/useFetchPost";


const GridPost = () => {

    const {data: posts, loading} = useFetchPost();

    return (<>
        {
            posts.map((post) => (
                <p key={post.id}>Hola</p>
            ))
        }
    </>)
}

export default GridPost;