// Creates associative array (object) of query queryParams
var queryParams = (function()
{
    var result = {};
    if (window.location.search)
    {
        var decoded = decodeURIComponent(window.location.search.replace(/\+/g, '%20'));
        // split up the query string and store in an associative array
        var queryParams = decoded.slice(1).split("&");
        for (var i = 0; i < queryParams.length; i++)
        {
            var tmp = queryParams[i].split("=");
            result[tmp[0]] = tmp[1];
        }
    }
    return result;
}());

jQuery(function($) {
  var params = queryParams
  for (var p in params) {
    var e = $('#'+p);
    var value = params[p];
    if (e != undefined && e != null) {
      e.text(value);
    }
  }
});
