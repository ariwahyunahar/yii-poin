function isJson(str) {
	var fixedJSON = str.replace(/(['"])?([a-zA-Z0-9_]+)(['"])?:/g, '"$2": ');
    try {
        JSON.parse(fixedJSON);
    } catch (e) {
        return false;
    }
    return true;
}
function postData(url, data)
{
  var form = $('<form></form>');
  $(form).hide().attr('method','post').attr('action',url);
  for (i in data)
  {
    var input = $('<input type="hidden" />').attr('name',i).val(data[i]);
    $(form).append(input);
  }
  $(form).appendTo('body').submit();
}

