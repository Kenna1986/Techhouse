/*
 * Transposh v0.8.3
 * http://transposh.org/
 *
 * Copyright 2012, Team Transposh
 * Licensed under the GPL Version 2 or higher.
 * http://transposh.org/license
 *
 * Date: Mon, 28 May 2012 14:38:35 +0300
 */
(function(a){var c={en:"English - English",af:"Afrikaans - Afrikaans",sq:"Albanian - Shqip",ar:"Arabic - \u0627\u0644\u0639\u0631\u0628\u064a\u0629",hy:"Armenian - \u0540\u0561\u0575\u0565\u0580\u0565\u0576",az:"Azerbaijani - az\u0259rbaycan dili",eu:"Basque - Euskara",be:"Belarusian - \u0411\u0435\u043b\u0430\u0440\u0443\u0441\u043a\u0430\u044f",bn:"Bengali - \u09ac\u09be\u0982\u09b2\u09be",bg:"Bulgarian - \u0411\u044a\u043b\u0433\u0430\u0440\u0441\u043a\u0438",ca:"Catalan - Catal\u00e0",zh:"Chinese (Simplified) - \u4e2d\u6587(\u7b80\u4f53)",
"zh-tw":"Chinese (Traditional) - \u4e2d\u6587(\u6f22\u5b57)",hr:"Croatian - Hrvatski",cs:"Czech - \u010ce\u0161tina",da:"Danish - Dansk",nl:"Dutch - Nederlands",eo:"Esperanto - Esperanto",et:"Estonian - Eesti keel",fi:"Finnish - Suomi",fr:"French - Fran\u00e7ais",gl:"Galician - Galego",ka:"Georgian - \u10e5\u10d0\u10e0\u10d7\u10e3\u10da\u10d8",de:"German - Deutsch",el:"Greek - \u0395\u03bb\u03bb\u03b7\u03bd\u03b9\u03ba\u03ac",gu:"Gujarati - \u0a97\u0ac1\u0a9c\u0ab0\u0abe\u0aa4\u0ac0",ht:"Haitian - Krey\u00f2l ayisyen",
he:"Hebrew - \u05e2\u05d1\u05e8\u05d9\u05ea",hi:"Hindi - \u0939\u093f\u0928\u094d\u0926\u0940; \u0939\u093f\u0902\u0926\u0940",hu:"Hungarian - Magyar",is:"Icelandic - \u00cdslenska",id:"Indonesian - Bahasa Indonesia",ga:"Irish - Gaeilge",it:"Italian - Italiano",ja:"Japanese - \u65e5\u672c\u8a9e",kn:"Kannada - \u0c95\u0ca8\u0ccd\u0ca8\u0ca1",ko:"Korean - \uc6b0\ub9ac\ub9d0",la:"Latin - Lat\u012bna",lv:"Latvian - Latvie\u0161u valoda",lt:"Lithuanian - Lietuvi\u0173 kalba",mk:"Macedonian - \u043c\u0430\u043a\u0435\u0434\u043e\u043d\u0441\u043a\u0438 \u0458\u0430\u0437\u0438\u043a",
ms:"Malay - Bahasa Melayu",mt:"Maltese - Malti",no:"Norwegian - Norsk",fa:"Persian - \u067e\u0627\u0631\u0633\u06cc",pl:"Polish - Polski",pt:"Portuguese - Portugu\u00eas",ro:"Romanian - Rom\u00e2n\u0103",ru:"Russian - \u0420\u0443\u0441\u0441\u043a\u0438\u0439",sr:"Serbian - C\u0440\u043f\u0441\u043a\u0438 \u0458\u0435\u0437\u0438\u043a",sk:"Slovak - Sloven\u010dina",sl:"Slovene - Sloven\u0161\u010dina",es:"Spanish - Espa\u00f1ol",sw:"Swahili - Kiswahili",sv:"Swedish - Svenska",tl:"Tagalog - Tagalog",
ta:"Tamil - \u0ba4\u0bae\u0bbf\u0bb4\u0bcd",te:"Telugu - \u0c24\u0c46\u0c32\u0c41\u0c17\u0c41",th:"Thai - \u0e20\u0e32\u0e29\u0e32\u0e44\u0e17\u0e22",tr:"Turkish - T\u00fcrk\u00e7e",uk:"Ukrainian - \u0423\u043a\u0440\u0430\u0457\u043d\u0441\u044c\u043a\u0430",ur:"Urdu - \u0627\u0631\u062f\u0648",vi:"Vietnamese - Ti\u1ebfng Vi\u1ec7t",cy:"Welsh - Cymraeg",yi:"Yiddish - \u05d9\u05d9\u05b4\u05d3\u05d9\u05e9"};a(function(){var f=function(){var d='<option value="">Unset</option>',e,g=a(this).data("lang");
a.each(c,function(a){e=a===g?'selected="selected"':"";d+='<option value="'+a+'"'+e+">"+c[a]+"</option>"});a(this).closest(".row-actions").toggleClass("row-actions-active").toggleClass("row-actions");a(this).replaceWith('<select data-cid="'+a(this).data("cid")+'">'+d+"</select>");a(".language select").change(function(){a.get(ajaxurl,{action:"tp_comment_lang",lang:a(this).val(),cid:a(this).data("cid")});var b=a(this).data("cid");a(this).closest(".row-actions-active").toggleClass("row-actions-active").toggleClass("row-actions");
a(this).replaceWith('<a data-cid="'+b+'" data-lang="'+a(this).val()+'" href="" onclick="return false">'+a("[data-cid="+b+"] option:selected").text()+"</a>");a("[data-cid="+b+"]").click(f)})};a(".language a").click(f)})})(jQuery);
