JsonContentType = 'application/json';

class Requests {

        constructor(){
            this.request = new XMLHttpRequest();
        }

        _request(method, url, data, onResponseCallback, contentType='') {
            const req = this.request;

            req.onreadystatechange = function() {
                if (req.readyState === XMLHttpRequest.DONE) {
                    onResponseCallback(req);
                }
            };
            req.open(method, url);
            req.setRequestHeader('Content-Type', contentType);
            if (contentType === JsonContentType) {
                req.responseType = 'json';
            }
            req.send(data);
        }

        post(url, onResponseCallback, data=null, json=null) {
            let contentType = '';
            if (json) {
                contentType = JsonContentType;
                data = JSON.stringify(json);
<<<<<<< HEAD
                // console.log(json);
                // console.log(data);
=======
                console.log(json);
                console.log(data);
>>>>>>> 74567574b281b6797ed0c5842981be6fc94d7b51
            } else {
                contentType = "application/x-www-form-urlencoded";
            }

            data = data || '';
            // console.log(data);
            this._request('POST', url, data, onResponseCallback, contentType)
        }

        get(url, onResponseCallback, data) {
            this._request('GET', url, onResponseCallback, data)
        }
    }