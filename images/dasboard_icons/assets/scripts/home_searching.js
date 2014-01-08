var http = getHTTPObject();

var url = "home_aritst_fuze_search_result?fuze_search=";

function handleArtistHttpResponse() 
{s   
    if (http.readyState == 4) 
    {
          if(http.status==200) 
          {
              var results=http.responseText;
              document.getElementById('div_artist_search_result').innerHTML = results;
          }
    }
}
function requestSearchInfo() 
{     
    var fuze_search = document.getElementById("fuze_search").value;
    http.open("GET", url + escape(fuze_search), true);
    http.onreadystatechange = handleArtistHttpResponse;
    http.send(null);
}
function getHTTPObject() 
{
    var xmlhttp;

if(window.XMLHttpRequest)
{
    xmlhttp = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    if (!xmlhttp)
    {
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }

}
    return xmlhttp;
}


function request_search_info()
{
    
}