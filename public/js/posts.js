function deletePost(id,user) {
    if (confirm("Are you sure you wish to delete this post?")) {


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $("#"+id).remove();
                $("#result").html("Post has been deleted.");
            }
        };
        xmlhttp.open("GET", "/posts/" + id + "/delete?user="+user, true);
        xmlhttp.send();
    }
}

function formSub() {
    $("#body").html($(".ql-editor").html());
    $("#form").submit();
}