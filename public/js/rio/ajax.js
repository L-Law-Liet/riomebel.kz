let ajaxPriceTimer = 0;
function ajaxFilter(reset, page) {
    let arr = [];
    if(reset === 1){
        arr = [];
    }
    else{
        arr = $(".ajax-filter").serializeArray();
        if (reset === 3){
            arr['page'] = page;
        }
    }
    phpUrl = document.getElementById('phpVal').getAttribute('url');
    phpPage = document.getElementById('phpVal').getAttribute('page');
    if(page > 0){
        urL = phpUrl+'?page='+page;
    }
    else {
        urL = phpUrl+'?page='+phpPage;
    }
    $.ajax({
        type : 'get',
        url : urL,
        data : {'a' : arr},
        success:function (data) {
            $('#Resp').html(data);
        },
    });
}
$('#reset_filter').on('click', function () {
    $('.ajax-filter').value = null;
    ajaxFilter(1, -1);
});
$('.ajax-filter').on('keyup', function (e) {
    if (e.target.name == 'from' || e.target.name == 'till') {
        clearTimeout(ajaxPriceTimer);
        ajaxPriceTimer = setTimeout(ajaxFilter(2, -1), 1000);
    }
    });

$('.ajax-filter').on('change', function () {
        ajaxFilter(2, -1);

});
$(document).ready(function () {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];

        let ref = document.location+"";
        if (ref.includes('?page=')){
            ref = ref.substring(0, ref.indexOf("?page="));
        }
        let param = ref+'?page='+page;

        window.history.pushState("object or string", "Title", param);
        ajaxFilter(3, page);

    });
});
