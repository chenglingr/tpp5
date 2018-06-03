
var defaults = {
	//	html: "<div>Hello World!</div>",
	//	css: "body {\n  font-family: '微软雅黑';\n  padding: 10px;\n  font-size: 13px;\n}\n"
		html:window.SCOPE.html,
		css:window.SCOPE.css
	};
	var doc,$body, $head, $style;
	var htmlEditor,cssEditor;
	var oldAllH;
	var oldHtmlboxH;
	var oldCssboxH;
	$(function(){
		$frame = $('<iframe id="frame">');
		$frame.addClass("blueprint");
		$("#desk").html($frame);
		setTimeout(function() {
			doc = $frame[0].contentWindow.document;
			$body = $("body", doc);
			$head = $("head", doc);
			$style = $("<style type='text/css'/>");
			$style[0].type = "text/css";
			$head.append($style);
			push();
		},
		1);

		enableHighlighting();

		oldAllH = $("#controls").height();
		$("#cssbox,#htmlbox").height($("#controls").height()/2);
		oldHtmlboxH = $("#htmlbox").height();
		oldCssboxH = $("#cssbox").height();
		$("#cssbox .content").css("height", $("#cssbox").height() - 22);
		$("#htmlbox .content").css("height", $("#htmlbox").height() - 22);
		
		htmlEditor.resize();
		cssEditor.resize();

		$("#cssbox").css("top", $("#htmlbox").height() + "px");
		$("#controls").resizable({
			handles: "e",
			resize: function(d, c) {
				$("#desk").css("left", c.size.width + "px");
				$("#controls").width(c.size.width);
				
				cssEditor.resize();
				htmlEditor.resize();
			},
			alsoResize: "#cssbox, #htmlbox"
		});
		$("#cssbox").resizable({
			handles: "n",
			resize: function(d, c) {
				$("#htmlbox").css("bottom", c.size.height + "px");
				$("#cssbox, #htmlbox").css("height", "auto");
				$("#cssbox .content").css("height", $("#cssbox").height() - 22);
				$("#htmlbox .content").css("height", $("#htmlbox").height() - 22);
				
				$("#cssbox").css("top", $("#htmlbox").height() + "px");
				$("#cssbox").css("height", c.size.height);
				
				htmlEditor.resize();
				cssEditor.resize();
				
				oldHtmlboxH = $("#htmlbox").height();
				oldCssboxH = $("#cssbox").height();
			},
			containment: "#controls",
			maxHeight: $("#controls").height() - 20,
			minHeight: 22
		});
		$(window).resize(function() {
			var newHtmlboxH = $("#controls").height() * (oldHtmlboxH / oldAllH);
			var newCssboxH = $("#controls").height() * (oldCssboxH / oldAllH);
			var newAllH = $("#controls").height();
			newHtmlboxH	= (newHtmlboxH<20?20:(newCssboxH<20?newAllH - 20:newHtmlboxH));
			newCssboxH = (newHtmlboxH<20?newAllH - 20:(newCssboxH<20?20:newCssboxH));
			$("#controls").css("top","33px");
			$("#cssbox, #htmlbox").css("height", "auto");
			$("#htmlbox").css("height", newHtmlboxH);
			$("#cssbox").css("height", newCssboxH);
			
			//console.log("old",oldAllH,oldCssboxH,oldHtmlboxH);
			//console.log("new",newAllH,newCssboxH,newHtmlboxH);
			$("#htmlbox").css("bottom", newCssboxH + "px");
			$("#cssbox").css("top", newHtmlboxH + "px");
			$("#cssbox .content").css("height", $("#cssbox").height() - 22);
			$("#htmlbox .content").css("height", $("#htmlbox").height() - 22);
			
			htmlEditor.resize();
			cssEditor.resize();

			$( "#cssbox" ).resizable( "option", "maxHeight", $("#controls").height() - 20 );
			oldAllH = $("#controls").height();
			oldHtmlboxH = $("#htmlbox").height();
			oldCssboxH = $("#cssbox").height();
		});
		$(".toggleLink").data("state", "open").click(function() {
			if ($(this).data("state") == "open") {
				hideCode()
			} else {
				showCode()
			}
			return false
		});
		$(".reset-link").click(function(e){
			resetCode();
		});

		$("#download").click(function(){
			html1 = htmlEditor.getValue();
            style1 = cssEditor.getValue();
			var content = "<html><head><style>"+style1+"</style></head><body>"+html1+"</body></html>";
    		var blob = new Blob([content], {type: "text/html;charset=utf-8"});
   			saveAs(blob, "file.html");
		//text/plain
		})
	});
	
	function hideCode() {
		var c = $("#controls");
		var b = $("#desk");
		var a = c.width();
		c.animate({
			left: "-" + a + "px"
		},
		"easeOutQuad",
		function() {
			$(".toggleLink").data("state", "closed").text("»").toggleClass("collapsed")
		});
		b.animate({
			left: 0
		},
		"easeOutQuad")
	}
	function showCode() {
		var c = $("#controls"),
		b = $("#desk"),
		a = c.width();
		c.animate({
			left: 0
		},
		"easeInQuad",
		function() {
			$(".toggleLink").data("state", "open").text("«").toggleClass("collapsed")
		});
		b.animate({
			left: a + "px"
		},
		"easeInQuad")
	}

	function push() {
		/*html = highlight ? htmlEditor.getSession().getValue() : $("#html").val();
		style = highlight ? cssEditor.getSession().getValue() : $("#css").val();*/
		html = htmlEditor.getValue();
		style = cssEditor.getValue();
		$body.html(html);
		addCss(style);
	}
	function addCss(a) {
		if ($style[0].styleSheet) {
			$style[0].styleSheet.cssText = a;
		} else {
			$style.html(a);
		}
	}
	function enableHighlighting() {
		/*$(".editor").each(function() {
			var c = $(this).val(),
			e = $(this).attr("id"),
			d = $("<div class='highlighted-editor' id=" + e + "></div>");
			d.text(c);
			$(this).replaceWith(d)
		});*/
		htmlEditor = ace.edit("html");
		htmlEditor.session.setMode("ace/mode/html");
		htmlEditor.setTheme("ace/theme/tomorrow");
		htmlEditor.setOptions({
			enableBasicAutocompletion: true,
			enableSnippets: true,
			enableLiveAutocompletion: false
		});
		
		cssEditor = ace.edit("css");
		cssEditor.session.setMode("ace/mode/css");
		cssEditor.setTheme("ace/theme/tomorrow");
		cssEditor.setOptions({
			enableBasicAutocompletion: true,
			enableSnippets: true,
			enableLiveAutocompletion: false
		});

		resetCode();

		htmlEditor.on("change",function(e){
			setTimeout(
				function(){
					if($("#html").find(".ace_error").length<=0)push();
				},500);
		});
		cssEditor.on("change",function(e){
			setTimeout(
				function(){
					if($("css").find(".ace_error").length<=0)push();
				},500);
		});
	}
	function resetCode() {
		htmlEditor.getSession().setValue(defaults.html);
		cssEditor.getSession().setValue(defaults.css);
	}