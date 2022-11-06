var App = {
    _init_() {
        this.init_components();
        this.init_eventListeners();
    },
    init_eventListeners() {
        $('[wxpclid="logout"]').click(() => {
            App.initLogout();
        })
    },
    initLogout() {
        if (confirm('Are you sure to logout!')) {
            $.ajax({
                url: './components/userAuth?alt=json&token=' + makeid(10),
                method: 'POST',
                data: {
                    action: 'process-logout',
                    curl: window.location.href
                },
                dataType: 'JSON'
            }).then(response => {
                if (response.error) {
                    alert(response.error)
                } else {
                    if (response.status == 200) {
                        window.location.replace(response.redirect);
                    }
                }
            })
        }
    },
    init_components() {
        this._share();
    },
    share(url){
        navigator.share({
            title: 'TimeTable App',

            // URL to share
            url: url
        }).then(() => {
            
        }).catch(err => {
            // Handle errors, if occured
            console.log("Error while using Web share API:");
            console.log(err);
        });
    },
    _share() {
        //check if native sharing option is available
        if (navigator.share) {
            var t = document.querySelectorAll('[key]');
            $.each(t, (k, val) => {
                var key = $(val).attr('key');
                Wxp_DOM.render(`<div onclick="App.share('${location.href}/${key}')" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <i class="uil uil-share-alt fs-16" style="color:#000 !important"></i>
            </div>`, `[key='${key}'] wxp-share`)
            })
        } else {
            console.log("Browser doesn't support this Share API!");
        }
    },
    urlParentLookup(url) {
        let v = url // {http://localhost/admin/post/new/KSPCN-T74F3-FTNB3-CJZNX}
        var k = v.split('/'), // splits url elements to array except '/' {http:  localhost admin post new KSPCN-T74F3-FTNB3-CJZNX}
            lastElmIndex = k.length - 1, //Finding last element index with array length
            lastElm = k[lastElmIndex] //Storing last element of the array to a variable {KSPCN-T74F3-FTNB3-CJZNX}
        if (lastElm === '') { //checking if the last array is an empty string
            k.splice(lastElmIndex, 1); //removes last array element if the above condition is true
            lastElm = k[lastElmIndex - 1]; //updating last element
        }
        k.pop() // removing last element of the array {http:  localhost admin post new }
        var str = k + '/', //converting array to string with '/' at the end {http:,,localhost,admin,post,new/}
            fstring = ''
        for (var i = 0; i < str.length; i++) {
            var tmp = str.charAt(i).replace(',', '/') //replacing comma from the string with '/' {http://localhost/admin/post/new/}
            fstring += tmp
        }
        return {
            parent: fstring, //Returns: {http://localhost/admin/post/new/}
            lastElm: lastElm //Returns: {KSPCN-T74F3-FTNB3-CJZNX}
        }
    }
}
App._init_();