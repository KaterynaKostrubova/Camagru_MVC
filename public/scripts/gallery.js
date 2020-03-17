let likeResponse = function(request) {
    let response = request.response;
    console.log(response);
    if (response.status === 'ok') {
        let selector = '#like-' + response['id'];
        let like = document.querySelector(selector);
        let numberLikes = document.querySelector('.number_likes');
        let n = Number(numberLikes.innerHTML);
        if(response['like'] === true)
            n--;
        else
            n++;
        numberLikes.innerHTML = n + '';
        like.classList.toggle("liked");
    }
};

function  like(e) {
    let req = new Requests();
    let el = e.target.id.split('-');
    let id = el[1] + '';
    let selector = '#like-' + id;
    let like = document.querySelector(selector).classList.contains('liked');
    let str ='';
    let data = {
        'id' : id,
        'like': like,
    };
    req.post('/camagru_mvc/api/like', likeResponse, str, data);
    e.preventDefault();
}


let commentResponse = function(request) {
    let response = request.response;
    // console.log(response);
    let comments = document.querySelector(".comments");

    let div1 = document.createElement("div");
    div1.className = "comment_block";
    comments.prepend(div1);

    let div2 = document.createElement("div");
    div2.className = "comment_login";
    div2.innerText = response['login'];
    div1.append(div2);

    let div3 = document.createElement("div");
    div2.className = "comment_text";
    div3.innerText = response['text'];
    div1.append(div3);

    let text = document.getElementById('text-' + response['id']);
    text.value = '';

    let numberComments = document.querySelector('.number_comments');
    let n = Number(numberComments.innerHTML);
    n++;
    numberComments.innerHTML = n + '';
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


let delCardResponse = function(request) {
    let response = request.response;
    if(response['flag'] === 'delete'){
        let del = document.querySelector('.img_card_' + response['id']);
        del.remove();
        let checkVisionImgCard = document.querySelector('.img_card');
        if (!checkVisionImgCard){
            let str = '';

            let data = {
                'counter': count,
                'n': 5,
            };
            let req = new Requests();
            req.post('/camagru_mvc/api/pagination', paginationResponse, str, data);
        }
    } else {
        let del = document.querySelector('.card');
        let wrap = document.querySelector('.wrapper');
        let div = document.createElement("div");
        div.className = 'deleted-photo';
        div.innerText = 'PHOTO DELETED';
        wrap.append(div);
        del.style.display = 'none';
    }
    if(response['path'] !== ''){
        let ava = document.querySelector('.avatar_min');
        ava.src = response['path'];
    }
};

function  deleteCard(e) {
    let req = new Requests();
    let el = e.target.id.split('_');
    let id = el[1] + '';
    let flag = el[0] + '';
    let str ='';
    let data = {
        'id' : id,
        'flag': flag,
    };
    req.post('/camagru_mvc/api/delete/photo', delCardResponse, str, data);
    e.preventDefault();
}