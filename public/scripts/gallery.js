let likeResponse = function(request) {
    let response = request.response;
    // console.log(response);
    if (response.status === 'ok') {
        let selector = '#like-' + response['id'];
        // + response['id']
        let like = document.querySelector(selector);
        like.classList.toggle("liked");
    }
};

function  like(e) {
    let req = new Requests();
    let el = e.target.id.split('-');
    let id = el[1] + '';
    let selector = '#like-' + id;
    let like = document.querySelector(selector).classList.contains('liked');
    // console.log(like);
    let str ='';
    let data = {
        'id' : id,
        'like': like,
    };
    // console.log(data);
    req.post('/camagru_mvc/api/like', likeResponse, str, data);
    e.preventDefault();
}


let commentResponse = function(request) {
    let response = request.response;
    console.log(response);
    let comments = document.querySelector(".comments");
    // let json_data = JSON.parse(response);
    //
    let div1 = document.createElement("div");
    div1.className = "comment_block";
    comments.prepend(div1);

    let div2 = document.createElement("div");
    div2.className = "comment_login";
    div2.innerText = response['usr'];
    div1.append(div2);

    let div3 = document.createElement("div");
    div2.className = "comment_text";
    div3.innerText = response['text'];
    div1.append(div3);

    let text = document.getElementById('text-' + response['id']);
    text.value = '';
};

function  postComment(e) {
    let el = e.target.id.split('-');
    // console.log(el);
    let id = el[1] + '';
    let selector = '.comment-' + id;
    let text = document.getElementById('text-' + id).value;
    if(text !== ""){
        let req = new Requests();
        console.log(text);
        let str ='';
        let data = {
            'id' : id,
            'text': text,
        };
        console.log(data);
        req.post('/camagru_mvc/api/comment', commentResponse, str, data);
        e.preventDefault();
    } else {
        console.log('empty');
    }

}
