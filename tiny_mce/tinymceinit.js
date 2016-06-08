tinyMCE.init({
    mode: "specific_textareas",
    editor_selector : "mceTextarea",
    theme: "advanced",
    language: "ru",
    table_inline_editing : true,
    plugins: "table",
    force_br_newlines : true,

    // Theme options
    theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3:  "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap" /* ,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen" */,
    //theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
    theme_advanced_toolbar_location: "top",
    theme_advanced_toolbar_align: "left",
    theme_advanced_statusbar_location: "bottom",
    theme_advanced_resizing: true,

    // Skin options
    skin: "o2k7",
    skin_variant: "silver"



});