import {useEffect, useState} from "react";
import getPosts from "../helpers/getPosts";

const useFetchPost = () => {

    const [state, setState] = useState({
        data: [],
        loading: true,
    });

    useEffect(() => {
        getPosts()
            .then(posts => {

                setState({
                    data: posts,
                    loading: false
                });

            })
    },[]);

    return state;
};

export default useFetchPost;