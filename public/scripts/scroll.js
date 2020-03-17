let block = document.querySelector('.public_gallery');
let count = 0;
let stop = 0;

let topBnt = document.querySelector('.top');

topBnt.addEventListener('click', function (e) {
    document.documentElement.scrollTop = 0;
    topBnt.style.display = 'none';
});

function addBtnTop(){
    topBnt.style.display = 'block';
}


let paginationResponse = function(request) {
    let response = request.response;
    // console.log('count p', response['n']);
    console.log(response);
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
    console.log(yOffset, contentHeight);
    if(y >= contentHeight)
    {
        count++;
        flag++;
        let data = {
            'counter': count,
            'n': n,
        };

        let req = new Requests();
        req.post('/camagru_mvc/api/pagination', paginationResponse, str, data);
    }

    if (yOffset > heightWin) {
        addBtnTop();
    }
}



window.addEventListener("scroll", function(e){
    if (!stop) {
        nextPhoto();

    }
});

window.onload = function (e){
    let str = '';
    let n = 5;
    let heightWin = window.innerHeight;
    let widthWin = window.innerWidth;
    console.log(heightWin, widthWin);

    let data = {
        'counter': count,
        'n': n,
    };

    let req = new Requests();
    req.post('/camagru_mvc/api/pagination', paginationResponse, str, data);
};

