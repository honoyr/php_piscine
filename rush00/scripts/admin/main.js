$(document).ready(function(){
    $("form").each(function(i,form){
        $("a.submit", form).live('click', function(){
            form.submit();
            return false;
        });
    });
    ajaxloader = $(".ajaxLoading");
});
var ajaxloader;
// Активировать редактор
var initEditor = function(textareas,block) {
	textareas.each(function(i,item){
		var textarea = $(item);
		var fieldName = textarea.attr('name');
	    textarea.markItUp(myWikiSettings);
	    textarea.wrap("<div class='textarea'><i><b></b></i></div>");
	    var button = block.find(".oActButtons a.preview[for='"+fieldName+"']");
	    var preview = block.find(".previewRow[for='"+fieldName+"']").hide();
	    var previewLoad = function() {
	        var text = $(textarea).val();
	        if (text){
	            ajaxloader.show();
	            $.post("admin/parser/wiki",{data:text},function(data){
	                preview.find(".oPreview").html(data);
	                button.unbind().click(previewHide);
	                ajaxloader.hide();
	                previewShow();
	            });
	        }
	    }
	    var previewHide = function() {
	        block.find(".oActButtons").removeClass("withPreview");
	        preview.hide();
	        button.unbind().click(previewShow);
	    }
	    var previewShow = function() {
	        block.find(".oActButtons").addClass("withPreview");
	        preview.show();
	        button.unbind().click(previewHide);
	    }
	    textarea.change(function(){
	        button.unbind().click(previewLoad);
	    });
	    textarea.parent().find(".markItUpHeader ul li").click(function(){
	        button.unbind().click(previewLoad);
	    });
	    button.click(previewLoad);
	});
}
function sprintf()
{
	if (!arguments || arguments.length < 1 || !RegExp)
	{
		return;
	}
	var str = arguments[0];
	var re = /([^%]*)%('.|0|\x20)?(-)?(\d+)?(\.\d+)?(%|b|c|d|u|f|o|s|x|X)(.*)/;
	var a = b = [], numSubstitutions = 0, numMatches = 0;
	while (a = re.exec(str))
	{
		var leftpart = a[1], pPad = a[2], pJustify = a[3], pMinLength = a[4];
		var pPrecision = a[5], pType = a[6], rightPart = a[7];
		numMatches++;
		if (pType == '%')
		{
			subst = '%';
		}
		else
		{
			numSubstitutions++;
			if (numSubstitutions >= arguments.length)
			{
				alert('Error! Not enough function arguments (' + (arguments.length - 1) + ', excluding the string)\nfor the number of substitution parameters in string (' + numSubstitutions + ' so far).');
			}
			var param = arguments[numSubstitutions];
			var pad = '';
			       if (pPad && pPad.substr(0,1) == "'") pad = leftpart.substr(1,1);
			  else if (pPad) pad = pPad;
			var justifyRight = true;
			       if (pJustify && pJustify === "-") justifyRight = false;
			var minLength = -1;
			       if (pMinLength) minLength = parseInt(pMinLength);
			var precision = -1;
			       if (pPrecision && pType == 'f') precision = parseInt(pPrecision.substring(1));
			var subst = param;
			       if (pType == 'b') subst = parseInt(param).toString(2);
			  else if (pType == 'c') subst = String.fromCharCode(parseInt(param));
			  else if (pType == 'd') subst = parseInt(param) ? parseInt(param) : 0;
			  else if (pType == 'u') subst = Math.abs(param);
			  else if (pType == 'f') subst = (precision > -1) ? Math.round(parseFloat(param) * Math.pow(10, precision)) / Math.pow(10, precision): parseFloat(param);
			  else if (pType == 'o') subst = parseInt(param).toString(8);
			  else if (pType == 's') subst = param;
			  else if (pType == 'x') subst = ('' + parseInt(param).toString(16)).toLowerCase();
			  else if (pType == 'X') subst = ('' + parseInt(param).toString(16)).toUpperCase();
		}
		str = leftpart + subst + rightPart;
	}
	return str;
}
function getBodyScrollTop(){
	return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}
//implement JSON.stringify serialization
JSON.stringify = JSON.stringify || function (obj) {
    var t = typeof (obj);
    if (t != "object" || obj === null) {
        // simple data type
        if (t == "string") obj = '"'+obj+'"';
        return String(obj);
    }
    else {
        // recurse array or object
        var n, v, json = [], arr = (obj && obj.constructor == Array);
        for (n in obj) {
            v = obj[n]; t = typeof(v);
            if (t == "string") v = '"'+v+'"';
            else if (t == "object" && v !== null) v = JSON.stringify(v);
            json.push((arr ? "" : '"' + n + '":') + String(v));
        }
        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
    }
};