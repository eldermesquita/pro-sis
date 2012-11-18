var ajaxPRO = function(url, data, target, msgOK, msgFAIL, slide){
  $.ajax({
      url: url,
      type: 'post',
      data: data,
      success: function(data) {

        // alert(data);

        if(data == "ok")
        {
          $('p.success:visible').remove()
          var msg = "<p class='success' style='display: none;'>" + msgOK + "</p>";
              $(target).after(msg);
              
              if(slide)
              {
                $(target).slideUp();
              }
              
              $('.success').fadeIn();
              $('#container').css('height', $(document).height() + "px");
        }

        if(data == "fail")
        {
          var msg = "<p class='fail'>" + msgFAIL + "</p>";
          $(target).after(msg);
        }
      }
  });
};


/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
	Version: 1.3
*/


(function($) {
	/** 
   * Dynamically create charts from tables
   * Just add class="linechart" and replace
   * 'line' with any type of chart.
   */
(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery)

	
	$('#telefone').mask('(99) 9999-9999');
	$('#cep').mask('99999-999');
	$('#admissao').mask('99/99/9999');
  $('#nasc').mask('99/99/9999');
	$('#cpf').mask('999.999.999-99');
	$('#rg').mask('99.999.999-9');
	
	

  // This array contains the colors that will be used in charts
  var colors = ['#005ba8','#1175c9',
                '#92d5ea','#ee8310',
                '#8d10ee','#5a3b16',
                '#26a4ed','#f45a90',
                '#e9e744'];

  $('.barchart').visualize({ type: 'bar', colors: colors });
  $('.linechart').visualize({ type: 'line', lineWeight: 2, colors: colors });
  $('.areachart').visualize({ type: 'area', lineWeight: 1, colors: colors });
  $('.piechart').visualize({ type: 'pie', colors: colors });
  $('.barchart, .linechart, .areachart, .piechart').hide();

  $.fn.jclock = function(options) {
    var version = '1.2.0';

    // options
    var opts = $.extend({}, $.fn.jclock.defaults, options);
         
    return this.each(function() {
      $this = $(this);
      $this.timerID = null;
      $this.running = false;

      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

      $this.timeNotation = o.timeNotation;
      $this.am_pm = o.am_pm;
      $this.utc = o.utc;
      $this.utc_offset = o.utc_offset;

      $this.css({
        fontFamily: o.fontFamily,
        fontSize: o.fontSize,
        backgroundColor: o.background,
        color: o.foreground
      });

      $.fn.jclock.startClock($this);

    });
  };
       
  $.fn.jclock.startClock = function(el) {
    $.fn.jclock.stopClock(el);
    $.fn.jclock.displayTime(el);
  }
  $.fn.jclock.stopClock = function(el) {
    if(el.running) {
      clearTimeout(el.timerID);
    }
    el.running = false;
  }
  $.fn.jclock.displayTime = function(el) {
    var time = $.fn.jclock.getTime(el);
    el.html(time);
    el.timerID = setTimeout(function(){$.fn.jclock.displayTime(el)},1000);
  }
  $.fn.jclock.getTime = function(el) {
    var now = new Date();
    var hours, minutes, seconds;

    if(el.utc == true) {
      var localTime = now.getTime();
      var localOffset = now.getTimezoneOffset() * 60000;
      var utc = localTime + localOffset;
      var utcTime = utc + (3600000 * el.utc_offset);
      now = new Date(utcTime);
    }
    hours = now.getHours();
    minutes = now.getMinutes();
    seconds = now.getSeconds();

    var am_pm_text = '';
    (hours >= 12) ? am_pm_text = " P.M." : am_pm_text = " A.M.";

    if (el.timeNotation == '12h') {
      hours = ((hours > 12) ? hours - 12 : hours);
    } else if (el.timeNotation == '12hh') {
      hours = ((hours > 12) ? hours - 12 : hours);
      hours   = ((hours <  10) ? "0" : "") + hours;
    } else {
      hours   = ((hours <  10) ? "0" : "") + hours;
    }

    minutes = ((minutes <  10) ? "0" : "") + minutes;
    seconds = ((seconds <  10) ? "0" : "") + seconds;

    var timeNow = hours + ":" + minutes + ":" + seconds;
    if ( (el.timeNotation == '12h' || el.timeNotation == '12hh') && (el.am_pm == true) ) {
     timeNow += am_pm_text;
    }

    return timeNow;
  };
       
  // plugin defaults
  $.fn.jclock.defaults = {
    timeNotation: '24h',
    am_pm: false,
    utc: false,
    fontFamily: '',
    fontSize: '',
    foreground: '',
    background: '',
    utc_offset: 0
  };

})(jQuery);


$('document').ready(function() {
  

  $('.faq li > a').on('click', function(e){
    e.preventDefault();

   $(this).next().slideToggle();

  });

  /**
   * Use the jQuery DataTables-plugin to add
   * interactive features to your tables.
   */
   
  $(".datatable").dataTable();
  
  /**
   * Use search in real-time 
   **/
  
   // Edit this url to match your search action
  // Nice animation on focus
  $(".dataTables_filter input").focus(function() { $(this).animate({ width: '200px' }) });
  $(".dataTables_filter input").blur(function() {
    if($(this).val() == "") { // Only go back to normal when nothing's filled in
      $(this).animate({ width: '150px' })
    }
  });
  
  /**
   * Tags in input fields
   */
  $('.tags').tagsInput();

  /**
   * Skin select boxes, checkboxes and radiobuttons
   */
   
  $('select').select_skin();
  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();
  
  /**
   * Functional secondary menu using tabs
   */
  
  $(".tab").hide();
  
  if($("nav#secondary ul li.current").length < 1) {
    $("nav#secondary ul li:first-child").addClass("current");    
  }
  
  var link = $("nav#secondary ul li.current a").attr("href");
  $(link).show();
  
  $("nav#secondary ul li a").click(function(e) {
	
	
	
    if(!$(this).hasClass("current")) {
      $("nav#secondary ul li").removeClass("current");
      $(this).parent().addClass("current");
      $(".tab").hide();
      var link = $(this).attr("href");
      $(link).fadeIn();
      initBackground();
      if($('#container').height() < window.innerHeight) {
        $('#container').css('height', window.innerHeight + "px");
      } 
    }
    return false;

    e.preventDefault();
  });
  
  /**
   * Validate your forms
   */
   
  $("form.validar").validate();
  
  /**
   * Gallery on hover
   */
   
  $(".gallery img").wrap("<div class=\"image\">");
  $(".gallery .image").append('<div class="overlay"></div><a href="#" class="button icon search">View</a>');
  $(".gallery .image").hover(function() {
    $(this).find("a").stop().animate({ opacity: 1}, 200);
    $(this).find(".overlay").stop().animate({ opacity: .5}, 200);
  }, function() {
    $(this).find("a").stop().animate({ opacity: 0}, 200);
    $(this).find(".overlay").stop().animate({ opacity: 0}, 200);
  });
  
  /**
   * Wysiwym-editor
   */
   
  $('.wysiwym').wymeditor({
    logoHtml: '',
    toolsItems: [
      {'name': 'Bold', 'title': 'Strong', 'css': 'wym_tools_strong'}, 
      {'name': 'Italic', 'title': 'Emphasis', 'css': 'wym_tools_emphasis'},
      {'name': 'InsertOrderedList', 'title': 'Ordered_List',
        'css': 'wym_tools_ordered_list'},
      {'name': 'InsertUnorderedList', 'title': 'Unordered_List',
        'css': 'wym_tools_unordered_list'},
      {'name': 'Indent', 'title': 'Indent', 'css': 'wym_tools_indent'},
      {'name': 'Outdent', 'title': 'Outdent', 'css': 'wym_tools_outdent'},
      {'name': 'CreateLink', 'title': 'Link', 'css': 'wym_tools_link'},
      {'name': 'Paste', 'title': 'Paste_From_Word', 'css': 'wym_tools_paste'},
      {'name': 'Undo', 'title': 'Undo', 'css': 'wym_tools_undo'},
      {'name': 'Redo', 'title': 'Redo', 'css': 'wym_tools_redo'}
    ],
    containersItems: [
      {'name': 'P', 'title': 'Paragraph', 'css': 'wym_containers_p'},
      {'name': 'H4', 'title': 'Heading_4', 'css': 'wym_containers_h4'}
    ]
  });
  

  
  /**
   * Make sure the background gradient reaches
   * the bottom of the page.
   */
  function initBackground() {
    if($('#container').height() < window.innerHeight) {
      $('#container').height(window.innerHeight);
    }
  }
  
  initBackground();

$('#relogio').jclock();

mydate = new Date();
myday = mydate.getDay();
mymonth = mydate.getMonth();
myweekday= mydate.getDate();
weekday= myweekday;
year = mydate.getFullYear();

if(myday == 0)
day = " domingo, ";

else if(myday == 1)
day = " segunda-feira, ";

else if(myday == 2)
day = " terça-feira, ";

else if(myday == 3)
day = " quarta-feira, ";

else if(myday == 4)
day = " quinta-feira, ";

else if(myday == 5)
day = " sexta-feira, ";

else if(myday == 6)
day = " sábado, ";

if(mymonth == 0)
month = " de Janeiro de ";

else if(mymonth ==1)
month = " de Fevereiro de ";

else if(mymonth ==2)
month = " de Março de ";

else if(mymonth ==3)
month = " de April de ";

else if(mymonth ==4)
month = " de Maio de ";

else if(mymonth ==5)
month = " de Junho de ";

else if(mymonth ==6)
month = " de Julho de ";

else if(mymonth ==7)
month = " de Agosto de ";

else if(mymonth ==8)
month = " de Setembro de ";

else if(mymonth ==9)
month = " de Outubro de ";

else if(mymonth ==10)
month = " de Novembro de ";

else if(mymonth ==11)
month = " de Dezembro de ";


$('.dataAtual').html(day + myweekday + month + year);

$('a.excluir').fancybox({
	
	'border': 'none',
	'transitionIn'  : 'elastic',
	'transitionOut' : 'elastic'
});

$('#abrirPerfil').fancybox({
	'transitionIn'  : 'elastic',
	'transitionOut' : 'elastic'
});

$("#cep").blur(function(e){
  $('#').focus();
    if($.trim($("#cep").val()) != ""){
        $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
            if(resultadoCEP["resultado"]){
                $("#rua").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
                $("#bairro").val(unescape(resultadoCEP["bairro"]));
                $("#cidade").val(unescape(resultadoCEP["cidade"]));
			$("#estado").val(unescape(resultadoCEP["uf"]));
            }else{
                //fail
            }
        });
    }
});

$('#proximaetapa').on('click', function(e){
    e.preventDefault();

    $.ajax({
      url : "receber.php",
      data: $('form#cadastrarF').serialize(),
      type: "post",
      success: function(data) {
        console.log(data);
        $('#cadastrarF').slideUp(function(){
          $('#descontos').fadeIn();
        });
      }
    });

    return false;
});

$('.salvarEdit').on('click', function(e){
  e.preventDefault();

// alert($('form#editarFunc').serialize());

  $.ajax({
      url : "receber.php?editar",
      data: $('form#editarFunc').serialize(),
      type: "post",
      success: function(data) {
        console.log(data);

        $('#content h3,.salvarEdit').remove();
        $('#editarFunc').slideUp(function(){
          $(this).html('<span style="color:#2A8D3E; font-size: 12px; font-weight: bold">Editado com sucesso!</span>');
          $(this).fadeIn();
        });
      }
    });


  return false;
});
  
});


$(window).resize(function(){
	if($('#container').height() < window.innerHeight) {
      $('#container').css('height', window.innerHeight + "px");
    } 
});


