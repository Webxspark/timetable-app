var App = {
    _init_(){
        this.init_eventListeners();
    },
    init_eventListeners(){
        $('[wxpclid="logout"]').click(() => {
            App.initLogout();
        })
    },
    initLogout(){
        if(confirm('Are you sure to logout!')){
            $.ajax({
                url: './components/userAuth?alt=json&token='+makeid(10),
                method: 'POST',
                data:{
                    action: 'process-logout',
                    curl: window.location.href
                },
                dataType: 'JSON'
            }).then(response => {
                if(response.error){
                    alert(response.error)
                } else {
                    if(response.status == 200){
                        window.location.replace(response.redirect);
                    }
                }
            })
        }
    }
}
App._init_();