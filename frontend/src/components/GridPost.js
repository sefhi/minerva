import React from "react";
import useFetchPost from "../hooks/useFetchPost";
import GridItem from "./GridItem";


const GridPost = () => {

    const {data: posts, loading} = useFetchPost();

    return (<>
        {
            posts.map((post) => (
                <GridItem key={post.id} {...post}></GridItem>
            ))
        }
    </>)
}

export default GridPost;