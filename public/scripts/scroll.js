let block = document.querySelector('.public_gallery');
let count = 0;
let stop = 0;

let topBnt = document.querySelector('.top');

topBnt.addEventListener('click', function (e) {
    document.documentElement.scrollTop = 0;
});

let paginationResponse = function(request) {
    let response = request.response;
    // console.log(response);
    if(response['nextPhotos'].length){
        let div = document.createElement('div');
        div.className = 'img_block';
        div.innerHTML = response['nextPhotos'];
        block.append(div);
    } else {
        stop = 1;
    }
};

let flag = 1;

function nextPhoto(){
    let contentHeight = block.offsetHeight;
    let yOffset   = window.pageYOffset;
    let heightWin = window.innerHeight;
    let y  = yOffset + heightWin;
    let str = '';
    let n = 5;
    // console.log(yOffset, contentHeight);
    if(y >= contentHeight)
    {
        count++;
        flag++;
        let data = {
            'counter': count,
            'n': n,
        };
        let req = new Requests();
        req.post('/camagru_mvc/api/infinite/pagination', paginationResponse, str, data);
    }
}

window.addEventListener("scroll", function(e){
    if (!stop)
        nextPhoto();
    if (window.pageYOffset > window.innerHeight)
        topBnt.style.display = 'block';
    else
        topBnt.style.display = 'none';
});

window.onload = function (e){
    let str = '';
    let n = 5;
    // console.log(count);
    let data = {
        'counter': count,
        'n': n,
    };

    let req = new Requests();
    req.post('/camagru_mvc/api/infinite/pagination', paginationResponse, str, data);
};

