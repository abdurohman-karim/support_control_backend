//select all
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);

});

$('form').submit(function() {
    let button = $(this).find("button[type=submit]:focus");
    button.prop('disabled',true);
    button.html('<i class="spinner-border spinner-border-sm text-light"></i> '+$(button).text() + '...');
});

$('.submitButtonConfirm').click(function () {

    if(confirm('Confirm action'))
    {
        $(this).prop('disabled',true);
        $(this).html('<i class="spinner-border spinner-border-sm text-light"></i> '+$($(this)).text() + '...');
        $(this).parents('form:first').submit();
    }
});


$('.submitButton').click(function () {

    $(this).prop('disabled',true);
    $(this).html('<i class="spinner-border spinner-border-sm text-light"></i> '+$($(this)).text() + '...');
});

function showDescription(obj,id) {
    $(obj).attr('hidden',true)
    $('#desription_'+id).attr('hidden',false)
}

function afterSubmit(obj){
    $(obj).prop('disabled',true);
    $(obj).html('<i class="spinner-border spinner-border-sm text-light"></i> '+$($(obj)).text() + '...');
    $(obj).parents('form:first').submit();
}
$( "#numberFormat" ).keyup(function() {
    let number = $(this).val().replace(/\D/g, '')
    $(this).val(addCommas(number))

});

$(".numberFormat").keyup(function(event) {
    let number = $(this).val().replace(/[^\d.]/g, '');
    $(this).val(addCommas(number));
});


function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$('.table').addClass('w-100').DataTable({
    responsive: true,
    searching: false,
    ordering: false,
    paging: false,
    info: false,
});
function dtMobile(table_id) {
    $('#'+table_id).addClass('w-100').DataTable({
        responsive: true,
        searching: false,
        ordering: false,
        paging: false,
        info: false,
    });
}
function setCookie(name,value) {
    const expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + 30);
    const cookieValue = encodeURIComponent(value) + '; expires=' + expirationDate.toUTCString() + '; path=/';
    document.cookie = name + '=' + cookieValue;
}

function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(`${name}=`)) {
            return decodeURIComponent(cookie.substring(name.length + 1));
        }
    }
    return null; // Cookie not found
}

function sidebarStatus() {
    var sidebar = getCookie('sidebar')
    if(sidebar === null){
        setCookie('sidebar','min');
    }else
    {
        if(sidebar === 'min') setCookie('sidebar','max')
        else setCookie('sidebar','min')
    }
}
