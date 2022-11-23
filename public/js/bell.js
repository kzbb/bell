function get_data(URL) {
    return $.ajax({
        url: URL,
        dataType: "json",
    });
}

function get_bells(url) {
    // const URL = "/index";
    const URL = url;

    get_data(URL).done(function (result) {

        const json = result['bells'];

        let btn_tag ='';
        let update_url = '';
        let html = '';

        for (let i = 0; i < json.length; i++) {

            update_url = "/update/" + json[i].uid;

            let status = json[i].status;
            if (json[i].status == 'calling') {
                btn_tag = '<button class="btn btn-danger" style="text-transform: capitalize" onclick="call(\'' + update_url + '\');">'
            } else {
                btn_tag = '<button class="btn btn-outline-success" style="text-transform: capitalize" onclick="call(\'' + update_url + '\');">'
            }

            let htmlParts = '<div class="col-md-6 col-xl-4">'
                + '<div class="card m-3">'
                    + '<div class="card-body">'
                        + '<div class="row">'
                            + '<a href="/edit/' + json[i].uid + '" class="text-decoration-none col col-md-12">'
                                + '<h3 class="px-2 bell-title">'
                                    + json[i].title
                                + '</h3>'
                            + '</a>'
                            + '<div class="col-auto col-md-12 text-end">'
                                + btn_tag
                                    + json[i].status
                                + '</button>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                + '</div>'
                + '</div>';

            html += htmlParts;
        }
        document.getElementById('bells').innerHTML = html;
    });

    setTimeout(function(){get_bells(url)}, 1000);
}

function get_one_bell() {
    const URL = "/show" + String(location.pathname);

    get_data(URL).done(function (result) {
        const bell = result['bell'];
        const group = result['group'];

        // const status = bell.status;
        if (bell.status == 'calling') {
            document.getElementById('call-btn').className = 'btn-calling';
        } else {
            document.getElementById('call-btn').className = 'btn-stand-by';
        }

        document.getElementById('bell_title').textContent = bell.title;
        document.getElementById('status').textContent = bell.status;
        document.getElementById('group_title').textContent = group.title;
    });

    setTimeout("get_one_bell()", 1000);
}

function call(URL) {
    const request = new XMLHttpRequest();
    request.open('GET', URL, true);
    request.send();
}

function update() {
    const URL = "/update" + String(location.pathname);
    call(URL);
}