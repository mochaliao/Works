$(function () {
    jQuery.validator.addMethod(
         'myCheckEmail',
        function (value, elem, params) {
            return value != "" || $("#Email").val() != "";
        },
         ''
     );

    jQuery.validator.unobtrusive.adapters.add(
		'checkEmail', [],
		function (options) {
		    options.rules["myCheckEmail"] = true;
		    options.messages['myCheckEmail'] = options.message;
		}
	);

    jQuery.validator.addMethod(
		'myCheckAccount',
	   function (value, elem, params) {
	       return value != "" || $("#Account").val() != "";
	   },
		''
	);

    jQuery.validator.unobtrusive.adapters.add(
		'checkAccount', [],
		function (options) {
		    options.rules["myCheckAccount"] = true;
		    options.messages['myCheckAccount'] = options.message;
		}
	);

    $.validator.unobtrusive.adapters.addBool("mustbetrue", "required");

    $("#TCLink").bind("click", function () {
        $("#MustRead").prop("checked", true);
    });

    var TitleItems = {
        T1: "Your full name:",
        T2: "Your email:",
        T3: "OR<br /> Your Account Number:",
        T4: "Friend's full name:",
        T5: "Friend's phone <span dir='ltr'>(+ ext.)</span>:",
        T6: "Friend's e-mail:"
    };

    for (var Itmes in TitleItems) {
        var DivName = "#" + Itmes;
        if ("@Culture.ToLower()" != "ar-ae") {
            $(DivName).before("<label class='col-xs-3'>" + TitleItems[Itmes] + "</label>");
        }
        else {
            $(DivName).after("<label class='col-xs-3'>" + TitleItems[Itmes] + "</label>");
        }
    }
})