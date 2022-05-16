const getPosts = async () => {

    const url = `http://localhost:9091/posts/all`;

    const resp = await fetch(url);
    const {data} = await resp.json();
    return data.map(({id: postId, title, content, createdAt, author}) => {
        const {id: authorId, name, username, website, email} = author;
        return {
            id: postId,
            title: title,
            content: content,
            createdAt: createdAt,
            author : {
                id: authorId,
                name,
                username,
                website,
                email
            }
        };
    })

}

export default getPosts;