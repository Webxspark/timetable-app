var admin = {
    _init_() {
        this.init_eventListeners();
    },
    init_eventListeners() {
        $('[delete]').click(function () {
            var key = $(this).attr('delete');
            if (confirm('Are you sure to delete this TimeTable!?')) {
                admin.handleDeleteEvent(key);
            }
        })
    },
    handleDeleteEvent(key) {
        $.ajax({
            url: './components/admin?alt=json&token=' + makeid(10),
            data: {
                action: 'delete',
                key: key
            },
            method: 'POST',
            dataType: 'JSON'
        }).then(response => {
            if (response.error) {
                alert(response.error);
            } else {
                Wxp_DOM.render('', `[key="${key}"]`, { animate: { settings: 'fade' } });
                setTimeout(() => {
                    $(`[key="${key}"]`).remove();
                }, 1200);
            }
        })
    }
}
admin._init_();