$(document).ready(init);

function init(){

    var url = "http://localhost/FOOD/src/";

    $page = window.location.href;
    console.log($page);

    switch($page){
        case url +'#start':
            $.ajax({
                type:"GET",
                url: url + '?page=start&ajax=true',
                success: function(data){

                },
                error: function(){
                    console.log(arguments);
                }
            });
            console.log("goToStartPage");
        break;

        case url +'#store':
            $.ajax({
                type:"GET",
                url: url + '?page=store&ajax=true',
                success: function(data){

                },
                error: function(){
                    console.log(arguments);
                }
            });
            console.log("goToStorePage");
        break;

        case url +'#list':

            $.ajax({
                type:"GET",
                url: url + '?page=list&ajax=true',
                success: function(data){
                    console.log(data);
                },
                error: function(){
                    console.log(arguments);
                }
            });
            console.log("goToListPage");
        break;
    }
}