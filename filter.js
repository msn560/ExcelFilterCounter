   
  
function filterFile_showFileName(event) {    
    var filename = $("#filterFile").val().replace(/.*(\/|\\)/, '');
    $(".filterFile-small").html(filename);
}
function searchinFile_showFileName(event) {    
    var filename = $("#searchinFile").val().replace(/.*(\/|\\)/, '');
    $(".searchinFile-small").html(filename);
}

$(document).ready(function () {
    $(".upUpBtn").click(function () {
        $("#loadingGIF").css({"display":"block"});
        $(".downloadBox").css({"display":"none"});
        $(".upUpBtn").css({"display":"none"});
        var fd = new FormData();
        var filterFile_files = $('#filterFile')[0].files[0];
        var searchinFile_files = $('#searchinFile')[0].files[0];
        var slct_filterFile = $("#filterFile_colmn").val();
        var slct_searchinFile = $("#searchinFile_colmn").val();
        var filterFile_colmn_w = $("#filterFile_colmn_w").val();
        fd.append('filterFile', filterFile_files);
        fd.append('searchinFile', searchinFile_files);
        fd.append('slct_filterFile', slct_filterFile);
        fd.append('slct_searchinFile', slct_searchinFile);
        fd.append('filterFile_colmn_w', filterFile_colmn_w);
        //https://stackoverflow.com/questions/2834350/get-checkbox-value-in-jquery => $('#tam_eslesme').is(":checked")
        if ($('#tam_eslesme').is(":checked")){
            var tam_eslesme = 1;
        }else{
            var tam_eslesme = 0 ;
        } 
        fd.append('tam_eslesme', tam_eslesme);
        $.ajax({
            url: 'filter_test_up.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                
                const obj = JSON.parse(response);
                if (obj.status==true){
                    $("#downloadLink").attr("href", obj.download);
                    $(".downloadBox").css({ "display": "block" });
                    
                }
                $("#loadingGIF").css({ "display": "none" });
                $(".upUpBtn").css({ "display": "block" });
            },
        });
        
    });
});