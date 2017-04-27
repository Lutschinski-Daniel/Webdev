// make form visible (to add a new vocab)
$( "div#newVocab" ).one( 'click', function() {
    document.getElementById("vocabForm").style.visibility = "visible";
});

// make the pendant of the clicked vocab visible
$("div.vocab").click(function(){
    $visLang = $(this).html();
    $invisLang = $(this).attr("langInv");
 
    $(this).text($invisLang);
    $(this).attr("langInv", $visLang);
});

// open link for project-site that is clicked on
$("div.projectDiv").click(function(){
    window.location = $(this).attr("urlTo");    
});

// make vocab-div darkgreen when users hovers over it
$("div.vocab").hover(
    function() {
        $(this).css('background-color', 'darkgreen');
    },
    function(){
        $(this).css('background-color', 'green');
    }
);